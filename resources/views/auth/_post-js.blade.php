<script src="js/vue.js"></script>
{{--<script src="https://unpkg.com/vue/dist/vue.js"></script>--}}
<script src="js/vue-resource.js"></script>
<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[id="_token"]').attr('content');

    var postApp = new Vue({
        el: '#post-app',
        data: {
            title: '',
            body: '',
            newCategory: '',
            tags: [],
            options: 'Select a category',
            selected: '',
            newTag: '',
            postId: '',
            published: 0,
            fileId: '',
        },
        mounted: function () {
            this.fetchCategories();
//            $('select').material_select();

        },
        methods: {
            publish: function () {
                this.published = 1;
                this.save();
            },
            save: function () {
                if (!this.postId) {
                    if (!this.title) {
                        notifyAsToast('You should have a title to save your post!', 'danger');
                    }
                    else {
                        this.$http.post('/post/get-post-id', {
                            title: this.title
                        }).then(function (response) {
                            this.postId = response.data;
                            this.save();
                        });
                    }
                }
                else {
                    this.$http.post('/post/save', {
                        post: this.postId,
                        title: this.title,
                        body: this.body,
                        category: this.selected,
                        tags: this.tags,
                        file: this.fileId
                    }).then(function () {
                        notifyAsToast('Save successful!', 'success');
                        this.published = 0;
                    })
                }
            },
            addTag: function () {
                var tag = this.newTag.toLowerCase();
                this.$http.post('/api/add-tag', {
                            name: tag
                        })
                        .then(function () {
                            if (this.tags.length == 0) {
                                this.tags = [tag];
                            }
                            else {
                                this.tags.push(tag);
                            }
                            this.newTag = '';
                            this.save();
                        });

            },
            removeTag: function (index) {
                this.tags.splice(index, 1);
                this.save();
            },
            categorySelect: function () {
                this.save();
            },
            fetchCategories: function () {
                this.$http.get('/api/fetch-categories')
                        .then(function (response) {
                            this.options = response.data;
                        })
            },
            addNewCategory: function () {
                this.$http.post('/api/add-category', {
                            name: this.newCategory
                        })
                        .then(function (response) {
                            this.options.push(response.data);
                            this.selected = response.data.id;
                        });
                this.newCategory = '';
                $('#modal-new-cat').closeModal();
            },

        }
    });
    $(document).ready(function () {
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();

        $('input[type=file]').on('change', function () {
            var formData = new FormData();
            formData.append('file', $('#file')[0].files[0]);

            $.ajax({
                        url: '/api/upload-file',
                        type: 'POST',
                        data: formData,
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,  // tell jQuery not to set contentType
                    })
                    .done(function (data) {
                        postApp.fileId = data;
                    });
        });


    });
</script>
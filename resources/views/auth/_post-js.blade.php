<script src="js/vue.js"></script>
{{--<script src="https://unpkg.com/vue/dist/vue.js"></script>--}}
<script src="js/vue-resource.js"></script>
<script>


    var postApp = new Vue({
        el: '#post-app',
        data: {
            title: '',
            body: '',
            newCategory: '',
            tags: '',
            options: 'Select a category',
            selected: '',
            newTag: '',
        },
        mounted: function () {
            this.fetchCategories();
            this.fetchTags();
//            $('select').material_select();

        },
        methods: {
            publish: function () {
                this.save();
            },
            save: function () {

            },
            fetchTags: function() {
                this.$http.get('/api/fetch-tags')
                        .then(function(response) {
                          this.tags = response.data;
                        })
            },
            addTag: function () {
                var tag = this.newTag.toLowerCase();
                this.$http.post('/api/add-tag', {
                            name: tag
                        })
                        .then(function () {
                            this.tags.push(tag);
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
            }

        }
    });
    $(document).ready(function () {
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();

        $('input[type=file]').on('change', function(){
            var formData = new FormData();
            formData.append('file', $('#file')[0].files[0]);

            $.ajax({
                url : '/api/upload-file',
                type : 'POST',
                data : formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
            });
        });


    });
</script>
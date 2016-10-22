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
            tags: ['java', 'python', 'android', 'laravel'],
            options: [
                {text: 'Tutorials', value: '1'},
                {text: 'Projects', value: '2'},
                {text: 'Self notes', value: '3'}
            ],
            selected: '',
            newTag: '',
        },
        mounted: function(){
//            $('select').material_select();

        },
        methods: {
            publish: function () {
                this.save();
            },
            save: function () {

            },
            addTag: function () {
                this.tags.push(this.newTag.toLowerCase());
                this.newTag = '';
                this.save();
            },
            removeTag: function (index) {
                this.tags.splice(index, 1);
                this.save();
            },
            categorySelect: function () {
                console.log(this.selected);
            },

            addNewCategory: function(){
                this.options.push({text: this.newCategory, value: this.options.length+1});
                this.newCategory = '';
                this.selected = this.options.length;
                $('#modal-new-cat').closeModal();
            }

        }
    });
    $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
    });
</script>
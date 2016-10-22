<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="_token" content="{{ csrf_token() }}"/>
    @include('base.css')
    <title>Post</title>
</head>
<body>
<div id="post-app" class="container">
    <div class="row">
        <div class="col s9">
            <div class="row">
                <div class="input-field col s12">
                    <input id="title"
                           type="text" name="title" v-model="title">
                    <label for="title">Title</label>
                </div>

                <div class="input-field col s12">
                    <textarea id="body"
                              class="materialize-textarea"
                              v-model="body"></textarea>
                    <label for="body">Body</label>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <a class="btn waves-effect waves-light" @click="publish()">Publish
                    <i class="material-icons right">send</i>
                    </a>
                    <a class="btn waves-effect waves-light blue right" @click="save()">Save
                    <i class="material-icons right">save</i></a>
                </div>
            </div>
        </div>

        <div class="col s3">
            <div class="row center">
                <div class="col s12">
                    <h4>Category</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <select v-model="selected" @change="categorySelect()" class="browser-default">
                                <option v-for="option in options" :value="option.value">
                                    @{{ option.text }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <a class="right modal-trigger" href="#modal-new-cat"><i class="material-icons left">create_new_folder</i>Add new category</a>
                </div>

                <div class="col s12">
                    <h4>Tags</h4>
                    <div class="row">
                        <div class="col s12">
                            <input placeholder="Tag"
                                   id="tag"
                                   type="text"
                                   name="tags" v-model="newTag" @keyup.enter="addTag()">
                        </div>
                    </div>

                    <div class="chip" v-for="(tag, index) in tags">
                        @{{ tag }}
                        <i class="close material-icons" @click="removeTag(index)">close</i>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="modal-new-cat" class="modal">
        <div class="modal-content">
            <h4>Add New Category</h4>
            <div class="row">
                <div class="col s12">
                    <input placeholder="New category"
                           id="category"
                           type="text"
                           name="tags" v-model="newCategory" @keyup.enter="addNewCategory()">
                </div>
            </div>
        </div>
    </div>

</div>

@include('base.js')
@include('auth._post-js')

</body>
</html>
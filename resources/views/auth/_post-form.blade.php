<div class="row">
    <div class="col s8">
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
                <a class="btn waves-effect waves-light" @click="publish()">@{{ published ? 'Unpublish' : 'Publish' }}
                <i class="material-icons right">send</i>
                </a>
                <a class="btn waves-effect waves-light blue right" @click="save()">Save
                <i class="material-icons right">save</i></a>
            </div>
        </div>
    </div>

    <div class="col s3 right">
        <div class="row center">
            <div class="col s12">
                <h4>Category</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <select v-model="selected" @change="categorySelect()" class="browser-default">
                        <option v-for="option in options" :value="option.id">
                            @{{ option.name }}
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

            <div class="col s12">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" id="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
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
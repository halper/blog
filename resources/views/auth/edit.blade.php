@extends('auth.post')

@section('post-content')
    <div class="row">
        <div class="col s8">
            <div class="row">
                <div class="input-field col s12">
                    <select v-model="selected" @change="categorySelect()" class="browser-default">
                    <option v-for="option in options" :value="option.id">
                        @{{ option.name }}
                    </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@stop
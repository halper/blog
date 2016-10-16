<div class="row">
    <div class="col s12">
        <img class="circle responsive-img z-depth-2"
             src="https://www.gravatar.com/avatar/{{md5('h.alper.dom@gmail.com')}}"/>
        <h4>About Me</h4>
        <p>
            <?php
            $bdate = \Carbon\Carbon::create(1985);
            $now = \Carbon\Carbon::now();
            $age = $now->diffInYears($bdate);
            ?>
            {{$age}} years old fellow from Turkey with a huge love for technology, science, sports & travel.
            Blogger, reader, developer, wannabe maker and husband.
        </p>

    </div>
    <div class="col s12">
        <h4>Follow Me</h4>
        <div class="row ssk-center">
            <div class="col s3">
                <a href="https://www.facebook.com/halperdom" class="ssk ssk-facebook ssk-lg ssk-round"></a>
            </div>
            <div class="col s3">
                <a href="https://twitter.com/halperdm" class="ssk ssk-twitter ssk-lg ssk-round"></a>
            </div>

            <div class="col s3">
                <a href="https://plus.google.com/u/0/+AlperD%C3%B6m" class="ssk ssk-google-plus ssk-lg ssk-round"></a>
            </div>
            <div class="col s3">
                <a href="https://www.linkedin.com/in/halperdom" class="ssk ssk-linkedin ssk-lg ssk-round"></a>
            </div>
        </div>
    </div>
    <div class="col s12">
        <h4>Subscribe</h4>

        <div class="card-panel cyan lighten-5 ">
            <p>Subscribe to get latest posts!</p>
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" type="text" class="validate">
                    <label for="name">Name</label>
                </div>

                <div class="input-field col s12">
                    <input id="surname" type="text" class="validate">
                    <label for="surname">Surname</label>
                </div>

                <div class="input-field col s12">
                    <input id="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>

                <button class="btn btn-flat waves-effect waves-light right" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>

            </div>
        </div>
    </div>

</div>
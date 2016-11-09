<script src="js/vue.js"></script>
{{--<script src="https://unpkg.com/vue/dist/vue.js"></script>--}}
<script src="js/vue-resource.js"></script>
<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[id="_token"]').attr('content');

    var subscribersApp = new Vue({
        el: '#subscribers-panel',
        data: {
            name: '',
            surname: '',
            email: '',
            username: '',
        },
        methods: {

            subscribe: function () {
                if (!this.username) {
                    if (this.name && this.surname && this.email) {
                        this.$http.post('/api/new-subscription', {
                            name: this.name,
                            surname: this.surname,
                            email: this.email
                        }).then(function () {
                            notifyAsToast('Thank you for your subscription!', 'success');
                        }, function () {
                            notifyAsToast('Something went wrong', 'error');
                        });
                    } else {
                        notifyAsToast('Please fill all the fields!', 'warning');
                    }
                }
            }
        }
    })

</script>
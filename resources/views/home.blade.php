<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css?v=1.0')}}">
    <title>Coba Notif</title>
</head>

<body>
    <div id="App" class="container">
        <div class="row">
            <ul v-if="notif.length>0" class="col-12">
                <li v-for="(n, index) in notif">
                    @{{n.message}}
                </li>
            </ul>
            <ul v-else class="col-12">
                <li> Belum ada notif</li>
            </ul>
        </div>
        <form class="row">
            <input type="text" v-model="message" class="col-10">
            <button class="btn btn-primary col-2" @click.prevent="pushNotif(message)">Push</button>
        </form>
    </div>
</body>
<script src="{{asset('js/app.js?v=1.0')}}"></script>
<script>
    var App = new Vue({
        el: '#App',
        data: {
            notif: [],
            message: 'PING!!!',
        },
        methods: {
            pushNotif(message) {
                axios.post("{{url('notif/push')}}", {
                        message: message
                    })
                    .then(response => {
                        console.log(response);
                        this.message = 'PING!!!';

                    })
                    .catch(error => {
                        console.log(error.response);

                    })
            },
            listenNotif() {
                Echo.channel('test-channel')
                    .listen('TestNotif', (e) => {
                        this.notif.push({message: e.message});
                        console.log(e);
                    });
            }
        },
        mounted() {
            this.listenNotif();
        }
    })

</script>

</html>

<template>
    <div class="container h-screen flex justify-center items-center">
        <div class="flex justify-center items-center">

            <form method="post" @submit.prevent="login($event)">
                <input type="hidden" name="_token" :value="token_csrf">
                <div class="form-group">
                    <div class="flex flex-col">
                        <label for="email" class="">E-mail</label>
                        <input type="text" id="email" name="email" v-model="email"
                            class="border border rounded border-sky-500 w-full text-sm p-2 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1">
                    </div>

                    <div class="flex flex-col mt-4 mb-4">
                        <label for="password" class="">Senha</label>
                        <input type="password" id="password" name="password" v-model="password"
                            class="border border rounded border-sky-500 w-full text-sm p-2 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1">
                    </div>

                    <div class="flex flex-col">
                        <button value="submit"
                            class="block w-full bg-purple-500 text-white rounded p-2 hover:bg-purple-600">Enviar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
export default {
    props: [
        'token_csrf'
    ],
    data() {
        return {
            email: '',
            password: '',
            errors: [],
        }
    },
    methods: {
        sweet(e) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: e
            })
        },
        login(e) {
            let url = 'http://127.0.0.1:8000/api/auth/login';
            let config = {
                method: 'POST',
                body: new URLSearchParams({
                    'email': this.email,
                    'password': this.password,
                })
            }

            fetch(url, config)
                .then(response => response.json())
                .then(data => {

                    if (data.error) {
                        this.errors = data.message
                        this.sweet(data.message)
                    }

                    if (data.token) {
                        document.cookie = 'token=' + data.token + ';SameSite=Lax'
                        e.target.submit()

                        if (data.redirect) {
                            this.$router.push('/' + data.redirect)
                        }
                    }

                })
                .catch(error => {
                    console.log('Erro na requisição', error)
                })
        }
    }

}
</script>

<template>
    <div class="container h-screen flex justify-center items-center">
        <div class="flex justify-center items-center">

            <form method="post" @submit.prevent="">
                <input type="hidden" name="_token" :value="token_csrf">

                <div class="form-group">
                    <div class="flex flex-col">
                        <label for="email" class="">E-mail</label>
                        <input type="text" id="email" class="border border rounded border-sky-500 w-full text-sm p-2">
                    </div>

                    <div class="flex flex-col mt-4 mb-4">
                        <label for="email" class="">Senha</label>
                        <input type="text" id="email" class="border border rounded border-sky-500 w-full text-sm p-2">
                    </div>

                    <div class="flex flex-col">
                        <button value="submit" class="block w-full bg-purple-500 text-white rounded p-2 hover:bg-purple-600">Enviar</button>
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

        }
    },
    methods: {
        login(e) {
            let url = '';
            let config = {
                method: 'POST',
                body: {
                    'email': '',
                    'password': '',
                }
            }

            fetch(url, config)
        }
    }

}
</script>

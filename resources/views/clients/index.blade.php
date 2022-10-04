<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue 3 Basics</title>
    <style>
        .box {
            background-color: purple;
            height: 200px;
            width: 200px;
        }
        .box.two{
            background-color: red;
        }
        .box.three{
            background-color: blue;
        }
        [v-cloak]{
            display: none;
        }
        input {
            margin: 10px;
            display: block;
        }
    </style>
</head>
<body>
    <div id="app" v-cloak>
        {{ greeting}}
        <input @keyup.enter="greet(greeting + '!!@')" v-model="greeting">
        <hr>
        <login-form></login-form>

        <button @click.prevent.stop="toggleBox">Toggle Box</button>
        <div v-if="isVisible" class="box"></div>
    </div>
   
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        let app = Vue.createApp({
            data: function(){
                return{
                    greeting: "Hello Vue 3!",
                    isVisible: false
                }
            },
            methods: {
                toggleBox() {
                    this.isVisible = !this.isVisible;
                },
                greet(greeting) {
                    console.log(greeting);
                }
            }
        })

        app.component('login-form', {
            template: `
              <form @submit.prevent="handleSubmit">
                <h1>{{ title }}</h1>
                <custom-input type="email" :label="passwordLabel" />
                <custom-input type="password" :label="emailLabel"/>
                <button>Log in </button>
              </form>
            `,
            components: ['custom-input'],
            data() {
                return {
                    title: 'Login Form',
                    email: '',
                    password: '',
                    emailLabel: 'Email',
                    passwordLabel: 'Password'
                }
            },
            methods: {
                handleSubmit() {
                    console.log(this.email, this.password)
                }
            }
        })

        // app.component('custom-input', {
        //     template: `
        //       <label>
        //         {{label}}
        //         <input type="text" v-model="inputValue">
        //       </label>
        //     `,
        //     props: ['label'],
        //     data() {
        //         return {
                    
        //         }
        //     }
        // })
        app.mount("#app")
    </script>
</body>
</html>
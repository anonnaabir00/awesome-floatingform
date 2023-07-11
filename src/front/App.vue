<template>
    <div>
        <div :class="buttonposition" class="fixed">

      <button @click="active=!active" :style="contactstyle" :class="buttonanimation" class="p-3 bg-blue-600 text-white text-base hover:bg-blue-600 font-bold py-2 px-4 rounded transition duration-300 transform hover:scale-105 shadow-md animate__animated animate__slow animate__infinite">
        <div class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
            </svg>
            <div class="ml-2">{{ contacttext }}</div>
        </div>
      </button>

      <vs-dialog not-padding v-model="active">
        <div class="p-10">
            <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ namelabel }}</label>
            <input v-model="name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jhon Doe" required>
        </div>
            <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ emaillabel }}</label>
            <input v-model="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="hello@example.com" required>
        </div>
        <div class="mb-6">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ phonelabel }}</label>
            <input v-model="phone" type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+14803229794">
        </div>
        <div class="mb-6">
    <label for="msg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ messegelabel }}</label>
    <textarea v-model="msg" id="msg" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
</div>
        <button @click="sendMsg" :style="submitstyle" class="w-full p-3 bg-blue-600 text-white text-base hover:bg-blue-600 font-bold py-2 px-4 rounded transition duration-300 transform hover:scale-105 shadow-md">
        <div class="flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg>
            <div class="ml-2">{{ submittext }}</div>
        </div>
    </button>
    <p class="text-center text-xs text-gray-400 mt-5">{{ footertext }}</p>
</div>

      </vs-dialog>
    </div>
    </div>

</template>

<script>
import Vue from 'vue';
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
import axios from 'axios';
import 'animate.css';

Vue.use(Vuesax);

export default {
        name: 'App',
        data:() => ({
        active: false,
        name: null,
        email: null,
        phone: null,
        msg: null,
        settings: affpro_settings.settings,
        contacttext: affpro_settings.settings.contacttext,
        submittext: affpro_settings.settings.submittext,
        buttonposition: affpro_settings.settings.contactposition.value,
        buttonanimation: affpro_settings.settings.contactanimation.value,
        contactstyle: {
            backgroundColor: affpro_settings.settings.contactbgcolor,
            color: affpro_settings.settings.contacttextcolor,
        },
        submitstyle: {
            backgroundColor: affpro_settings.settings.submitbgcolor,
            color: affpro_settings.settings.submittextcolor,
        },
        footertext: affpro_settings.settings.footertext,
        namelabel: affpro_settings.settings.namelabel,
        emaillabel: affpro_settings.settings.emaillabel,
        phonelabel: affpro_settings.settings.phonelabel,
        messegelabel: affpro_settings.settings.messegelabel,
      }),
        methods: {
            sendMsg() {
                if (this.name === null || this.email === null || this.msg === null) {
                    const noti = this.$vs.notification({
                    duration: 2000,
                    progress: 'auto',
                    position: 'top-right',
                    color: 'danger',            
                    title: 'Error',
                    text: `Please fill all fields...`
                })
                return;
                }
        const noti = this.$vs.notification({
            duration: 2000,
            progress: 'auto',
            position: 'top-right',
            color: 'warning',            
            title: 'Sending message...',
            text: `Please wait...`
          })

          
          axios({
              method: 'post',
              url: '/wp-json/awesome-floatingform-pro/v1/email',
              data: {
                  email: this.name,
                  subject: this.email,
                  message: this.msg
              }
          }).then( (response) => {
                // console.log(response);
                setTimeout(() => {
                noti.close();

                const notification = this.$vs.notification({
                    duration: 3000,
                    progress: 'auto',
                    position: 'top-right',
                    color: 'success',            
                    title: 'Message sent',
                    text: `Thank you for contacting us.`
                })
                }, 2000);
          }).catch(function (error) {
              console.log(error);
          });
      }
        },
        mounted() {
            console.log(this.settings);
        }

}
</script>
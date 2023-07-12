<template>
    
  <div class="w-full max-w-7xl mx-auto p-16">
    <h1 class="text-3xl font-semibold mb-8">General Settings</h1>
      
      <div class="mb-8 w-4/6">
        <lv-dropdown bottom-bar v-model="adminemail" :options="emailtype" label="Admin Email" optionLabel="name" placeholder="Set Admin Email" clearable />
      </div>

      <div v-if="showCustomEmailField" class="mb-8 w-4/6">
        <lv-input id="email" class="focus:!outline-none" type="email" v-model="customemail" label="Custom Email Address" placeholder="hello@example.com" bottom-bar />
      </div>

      <div class="mb-8 w-4/6">
        <lv-input id="text" class="focus:!outline-none" type="text" v-model="footertext" label="Footer Text" placeholder="Contact Us" bottom-bar />
      </div>

      <div class="mb-4">
        <LvButton @click="saveSettings()" label="Save Settings" push deep-shadow class="lv--success" />
      </div>

  </div>

</template>

<script>
import Vue from 'vue';
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
import axios from 'axios';

import LvInput from 'lightvue/input';
import LvButton from 'lightvue/button';
import LvDropdown from 'lightvue/dropdown';

Vue.use(Vuesax);

Vue.component('LvInput', LvInput);

export default({
    name: 'General',
    data: () => ({
        adminemail: affpro_settings.settings.adminemail,
        customemail: affpro_settings.settings.customemail,
        footertext: affpro_settings.settings.footertext,
        showCustomEmailField: false,
        emailtype: [
          { name: 'WordPress Admin Email', value: 'wordpress_admin' },
          { name: 'Custom Email', value: 'custom_email' },
      ],
    }),
    components: {
    LvInput,
    LvButton: LvButton,
    LvDropdown: LvDropdown
  },
    methods: {
        saveSettings(){
            console.log(this.adminemail.value);
            
            var url = affpro_settings.root + 'awesome-floatingform-pro/v1/settings/save';
            axios({
            method: 'post',
            url: url,
            data: {
                adminemail: this.adminemail,
                customemail: this.customemail,
                footertext: this.footertext,
            }
            }).then (response => {
                const noti = this.$vs.notification({
                    color: '#630CDA',
                    duration: 2000,
                    progress: 'auto',
                    position: 'top-right',
                    title: 'Settings Saved Successfully',
                    square: true
                })
            }).catch (error => {
                console.log(error);
            }); 

        }
    },
    mounted() {
      // console.log(this.adminemail);
   },
   watch: {
    adminemail(newVal) {
    if (newVal.value === 'custom_email') {
      this.showCustomEmailField = true;
    } else {
      this.showCustomEmailField = false;
    }
  },
   }
})


</script>
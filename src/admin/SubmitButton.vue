<template>
    
    <div class="w-full max-w-7xl mx-auto p-16">
      <h1 class="text-3xl font-semibold mb-8">Submit Button Settings</h1>
  
        <div class="mb-8 w-4/6">
          <lv-input id="text" class="focus:!outline-none" type="text" v-model="submittext" label="Button Text" placeholder="Submit Now" bottom-bar />
        </div>
  
        <div class="grid grid-cols-1 gap-8 mb-8 w-4/6">
          <LvColorpicker label="Background Color" v-model="submitbgcolor" clearable />
          <LvColorpicker label="Text Color" v-model="submittextcolor" clearable />
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
  import LvColorpicker from 'lightvue/color-picker';
  import LvButton from 'lightvue/button';
  
  Vue.use(Vuesax);
  
  Vue.component('LvInput', LvInput);
  
  export default({
      name: 'SubmitButton',
      data: () => ({
          submittext: affpro_settings.settings.submittext,
          submitbgcolor: affpro_settings.settings.submitbgcolor,
          submittextcolor: affpro_settings.settings.submittextcolor,
      }),
      components: {
      LvInput,
      LvColorpicker: LvColorpicker,
      LvButton: LvButton
    },
      methods: {
          saveSettings(){
              var url = affpro_settings.root + 'awesome-floatingform-pro/v1/settings/save';
              axios({
              method: 'post',
              url: url,
              data: {
                  submittext: this.submittext,
                  submitbgcolor: this.submitbgcolor,
                  submittextcolor: this.submittextcolor,
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
  
      }
  })
  
  
  </script>
<template>
    
    <div class="w-full max-w-7xl mx-auto p-16">
      <h1 class="text-3xl font-semibold mb-8">Contact Button Settings</h1>
        
        <div class="mb-8 w-4/6">
          <lv-dropdown bottom-bar v-model="contactposition" :options="positions" label="Button Position" optionLabel="name" placeholder="Set Button Position" clearable />
        </div>

        <div class="mb-8 w-4/6">
          <lv-input id="text" class="focus:!outline-none" type="text" v-model="contacttext" label="Button Text" placeholder="Contact Us" bottom-bar />
        </div>
  
        <div class="grid grid-cols-1 gap-8 mb-8 w-4/6">
          <LvColorpicker label="Background Color" v-model="contactbgcolor" clearable />
          <LvColorpicker label="Text Color" v-model="contacttextcolor" clearable />
        </div>

        <div class="mb-8 w-4/6">
          <lv-dropdown bottom-bar v-model="contactanimation" :options="animations" label="Button Animation" optionLabel="name" placeholder="Set Button Animation" clearable />
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
  import LvDropdown from 'lightvue/dropdown';
  
  Vue.use(Vuesax);
  
  Vue.component('LvInput', LvInput);
  
  export default({
      name: 'ContactButton',
      data: () => ({
        settings: affpro_settings.settings,
        contacttext: affpro_settings.settings.contacttext,
        contactbgcolor: affpro_settings.settings.contactbgcolor,
        contacttextcolor: affpro_settings.settings.contacttextcolor,
        contactposition: affpro_settings.settings.contactposition,
        contactanimation: affpro_settings.settings.contactanimation,
        positions: [
            { name: 'Bottom Left', value: 'sm:left-10 md:left-14 sm:bottom-10 md:bottom-10' },
            { name: 'Bottom Right', value: 'sm:right-10 md:right-14 sm:bottom-10 md:bottom-10' },
        ],
        animations: [
            { name: 'Swing', value: 'animate__swing' },
            { name: 'Bounce', value: 'animate__bounce' },
            { name: 'Jello', value: 'animate__jello' },
            { name: 'Pulse', value: 'animate__pulse' },
            { name: 'Heart Beat', value: 'animate__heartBeat' },
            { name: 'Wobble', value: 'animate__wobble' },
            { name: 'Tada', value: 'animate__tada' },
            { name: 'Flash', value: 'animate__flash' },
            { name: 'Flip', value: 'animate__flip' },
            { name: 'Jack In The Box', value: 'animate__jackInTheBox' },
            { name: 'Rubber Band', value: 'animate__rubberBand' },
            { name: 'Shake Horizontal', value: 'animate__shakeX' },
            { name: 'Shake Vertical', value: 'animate__shakeY' },
        ],
      }),
      components: {
      LvInput,
      LvColorpicker: LvColorpicker,
      LvButton: LvButton,
      LvDropdown: LvDropdown
    },
      methods: {
          saveSettings(){
              var url = affpro_settings.root + 'awesome-floatingform-pro/v1/settings/save';
              axios({
              method: 'post',
              url: url,
              data: {
                  contacttext: this.contacttext,
                  contactbgcolor: this.contactbgcolor,
                  contacttextcolor: this.contacttextcolor,
                  contactposition: this.contactposition,
                  contactanimation: this.contactanimation
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
        console.log(this.settings);
     }
  })
  
  
  </script>
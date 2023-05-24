<template>
    <div class="w-3/6 mx-auto mt-20 mb-4 bg-white shadow-md">
  <div class="w-full max-w-7xl mx-auto p-16">
    <h1 class="text-3xl font-semibold mb-8">WP Floating Form</h1>

      <div class="mb-8 w-4/6">
        <lv-input id="contacttext" class="focus:!outline-none" type="text" v-model="contacttext" label="Contact Button Text" placeholder="Contact Us" bottom-bar />
      </div>

      <div class="mb-8 w-4/6">
        <lv-input id="submittext" class="focus:!outline-none" type="text" v-model="submittext" label="Submit Button Text" placeholder="Submit Now" bottom-bar />
      </div>

      <div class="grid grid-cols-1 gap-8 mb-8 w-4/6">
        <LvColorpicker label="Contact Button Color" v-model="contactcolor" clearable />
        <LvColorpicker label="Submit Button Color" v-model="submitcolor" clearable />
      </div>

      <div class="mb-4">
        <LvButton @click="saveSettings()" label="Save Settings" push deep-shadow class="lv--success" />
      </div>

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
    name: 'Admin',
    data: () => ({
        contacttext: wff_settings.contact_button_text,
        submittext: wff_settings.submit_button_text,
        contactcolor: wff_settings.contact_button_color,
        submitcolor: wff_settings.submit_button_color,
    }),
    components: {
    LvInput,
    LvColorpicker: LvColorpicker,
    LvButton: LvButton
  },
    methods: {
        saveSettings(){
            var url = wff_settings.root + 'wp-floatingform/v1/settings/save';
            axios({
            method: 'post',
            url: url,
            data: {
                contacttext: this.contacttext,
                submittext: this.submittext,
                contactcolor: this.contactcolor,
                submitcolor: this.submitcolor,
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
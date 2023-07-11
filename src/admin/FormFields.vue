<template>
    
  <div class="w-full max-w-7xl mx-auto p-16">
    <h1 class="text-3xl font-semibold mb-8">Form Fields Settings</h1>

      <div class="mb-8 w-4/6">
        <lv-input id="text" class="focus:!outline-none" type="text" v-model="namelabel" label="Name Field Label" placeholder="Your Name" bottom-bar />
      </div>

      <div class="mb-8 w-4/6">
        <lv-input id="text" class="focus:!outline-none" type="text" v-model="emaillabel" label="Email Field Label" placeholder="Your Email" bottom-bar />
      </div>

      <div class="mb-8 w-4/6">
        <lv-input id="text" class="focus:!outline-none" type="text" v-model="phonelabel" label="Phone Field Label" placeholder="Your Phone" bottom-bar />
      </div>

      <div class="mb-8 w-4/6">
        <lv-input id="text" class="focus:!outline-none" type="text" v-model="messegelabel" label="Messege Field Label" placeholder="Messege" bottom-bar />
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
    name: 'FormFields',
    data: () => ({
        namelabel: affpro_settings.settings.namelabel,
        emaillabel: affpro_settings.settings.emaillabel,
        phonelabel: affpro_settings.settings.phonelabel,
        messegelabel: affpro_settings.settings.messegelabel,
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
                namelabel: this.namelabel,
                emaillabel: this.emaillabel,
                phonelabel: this.phonelabel,
                messegelabel: this.messegelabel,
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
<template>

    <q-layout view='hHh lpR fFf' class="DashboardLayout">

        <q-header reveal elevated class="text-white DashboardLayoutHeader">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />

                <q-toolbar-title>
                </q-toolbar-title>

                <q-btn dense flat round icon="menu" @click="toggleRightDrawer" />
            </q-toolbar>
        </q-header>

        <q-drawer v-model="leftDrawerOpen" side="left" elevated>
            
            <q-list seperator>

                <q-item class="DashboardItem" v-for="(item, index) in accessMenu" :key="index" :to="{ name : item.route }" clickable>

                    <q-avatar><q-icon :name="item.icon"></q-icon></q-avatar>
                    <q-item-section>

                        <q-item-label class="q-ml-sm">{{ item.name }}</q-item-label>
                    </q-item-section>

                </q-item>
            </q-list>
        </q-drawer>

        <q-drawer show-if-above v-model="rightDrawerOpen" side="right" elevated>
            
            <div class="avatarBox row items-center justify-center">
                <q-avatar size="150px" class="overlapping">
                <q-img :src="profile.avatar"></q-img>
                </q-avatar>
            </div>

            <div class="q-pa-md row items-start q-gutter-md justify-center">
                <q-card flat class="DashboardCard text-center">
                    <q-card-section>
                        <div class="text-h3 text-white">Profile</div>
                    </q-card-section>

                    <q-card-section class="q-pt-none">
                        <div class="text-h6 text-white">User Name</div>
                        <span class="text-white">{{ profile.username }}</span>
                    </q-card-section>

                    <q-card-section class="q-pt-none">
                        <div class="text-h6 text-white">E-Mail</div>
                        <span class="text-white">{{ profile.email }}</span>
                    </q-card-section>
                </q-card>
            </div>
            <div class="q-pa-md q-gutter-sm text-center">
                
                <q-btn class="updateBtn" @click="prompt = true">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="2.3em" width="2.3em" xmlns="http://www.w3.org/2000/svg"><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h274.9c-2.4-6.8-3.4-14-2.6-21.3l6.8-60.9 1.2-11.1 7.9-7.9 77.3-77.3c-24.5-27.7-60-45.5-99.9-45.5zm45.3 145.3l-6.8 61c-1.1 10.2 7.5 18.8 17.6 17.6l60.9-6.8 137.9-137.9-71.7-71.7-137.9 137.8zM633 268.9L595.1 231c-9.3-9.3-24.5-9.3-33.8 0l-37.8 37.8-4.1 4.1 71.8 71.7 41.8-41.8c9.3-9.4 9.3-24.5 0-33.9z"></path></svg>
                </q-btn>
                <q-btn class="logoutBtn" @click="logout" >
                
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linejoin="round" height="3em" width="2em" xmlns="http://www.w3.org/2000/svg"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>

                </q-btn>
                <q-dialog v-model="prompt" persistent>
                    <q-card class="popup" style="min-width: 350px">

                        <q-card-section>
                            <div class="text-h6">Update Profile</div>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-input class="UpdateProfileUsername" :model-value="profile.username" @keyup.enter="prompt = false" label="Your User Name" outlined color="green" label-color="lime"/>
                        </q-card-section>

                        <q-card-section class="q-pt-none text-white">
                            <q-input class="UpdateProfileEmail" :model-value="profile.email" @keyup.enter="prompt = false" label="Your E-Mail" outlined color="green" label-color="lime"/>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-file bottom-slots v-model="model" label="Label" color="green" outlined label-color="white" counter :counter-label="counterLabelFunction" accept="image/*" @rejected="onRejected">
                                <template v-slot:prepend>
                                    <q-icon name="cloud_upload" @click.stop.prevent color="white"/>
                                </template>
                                <template v-slot:append>
                                    <q-icon name="close" @click.stop.prevent="model = null" class="cursor-pointer" color="red" />
                                </template>

                                <template v-slot:hint>
                                    <span class="fileSizeHint">File Size</span>
                                </template>
                            </q-file>
                        </q-card-section>
                        <q-card-actions align="right" class="text-primary">
                            <q-btn flat label="Cancel" v-close-popup color="red"/>
                            <q-btn flat label="Submit" v-close-popup color="green"/>
                        </q-card-actions>
                    </q-card>
                </q-dialog>
            </div>
        </q-drawer>

        <q-page-container>
            <router-view />
        </q-page-container>
    </q-layout>
</template>

<script>

import { ref } from 'vue'
import { accessMenu } from 'src/components/dashboard/ts/menuListComponent';
import { profile } from 'src/components/dashboard/ts/profileComponent'
import {useRouter} from 'vue-router'
import { useAuthStore } from 'src/stores/auth-store';
import { Notify } from 'quasar'; 
import auth from 'src/boot/auth';

export default {
  setup () {
    const leftDrawerOpen = ref(false)
    const rightDrawerOpen = ref(false)
    const authStore = useAuthStore();
    const router = useRouter();

    return {
      leftDrawerOpen,
      accessMenu,
      profile,
      toggleLeftDrawer () {
        leftDrawerOpen.value = !leftDrawerOpen.value
      },
      rightDrawerOpen,
      toggleRightDrawer () {
        rightDrawerOpen.value = !rightDrawerOpen.value
      },
      prompt: ref(false),
      model: ref(null),

      logout() {

        authStore.logout();
        router.replace({name:'login'});
      },

      counterLabelFunction({totalSize}){

        return `(${totalSize})`
      },

      onRejected(rejectedFile){

        rejectedFile.forEach(File => {
            if (File.failedPropValidation) {

                Notify.create({

                    message: 'Only images allowed',
                    type: 'negative',
                })
            }
        })
      }
    }
  }
}

</script>

<style>

.DashboardLayout {
    background-image: url(../../image/loginWallpaper.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}
.DashboardLayoutHeader {

    background-color: transparent;
}
.q-drawer {

    background-color: transparent;
}
.DashboardCard {

    background-color: transparent;
}
.DashboardItem {

    color: white;
    width: 95%;
    margin: 0 auto;
    margin-top: 10px;
    border-radius: 20px;
}
.DashboardItem:visited {

    color: white;
}
.DashboardItem:hover {

    background-color: rgb(30, 30, 202);
    transition: 0.2s ease-in-out;
    transform: scale(103%);
}
.avatarBox {

    width: 100%;
    height: 300px;
}
.noBorder {

    border: none;
}
.popup {

    background-color: rgba(41, 35, 35, 0.966);
    color: whitesmoke;
}
.updateBtn {

    height: 65px;
    margin-bottom: 5px;
    border-radius: 100px;
    border: 2px solid transparent;
    background-color: transparent;
    color: white;
}
.updateBtn:hover {

    transition: 0.2s ease-in-out;
    transform: scale(103%);
    color: #2cac2c;
}
.logoutBtn {

    height: 60px;
    background-color: transparent;
    border-radius: 100px;
    color: azure;
}
.logoutBtn:hover {

    color: red;
    transition: 0.2s ease-in-out;
    transform: scale(103%);
    background-color: transparent;
}
.UpdateProfileUsername input{

    color: white;
    
}

.UpdateProfileEmail input{

    color: white;
}

.fileSizeHint{

    color: white;
}
</style>
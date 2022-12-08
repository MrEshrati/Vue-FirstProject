<template>

    <q-layout view='hHh lpR fFf'>

        <q-header reveal elevated class="text-white">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />

                <q-toolbar-title>
                </q-toolbar-title>

                <q-btn dense flat round icon="menu" @click="toggleRightDrawer" />
            </q-toolbar>
        </q-header>

        <q-drawer v-model="leftDrawerOpen" side="left" elevated>
            
            <q-list seperator>

                <q-item v-for="(item, index) in accessMenu" :key="index" :to="{ name : item.route }" clickable>

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
                <q-card flat class="my-card text-center">
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
                
                <q-btn class="updateBtn" label="Update" @click="prompt = true" />
                <br/>
                <q-btn class="logoutBtn" @click="logout" >
                
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linejoin="round" height="3em" width="2em" xmlns="http://www.w3.org/2000/svg"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>

                </q-btn>
                <q-dialog v-model="prompt" persistent>
                    <q-card class="popup" style="min-width: 350px">

                        <q-card-section>
                        <div class="text-h6">Update Profile</div>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-input dense :model-value="profile.username" @keyup.enter="prompt = false" label="Your User Name" />
                        </q-card-section>

                        <q-card-section class="q-pt-none text-white">
                            <q-input dense :model-value="profile.email" @keyup.enter="prompt = false" label="Your E-Mail" />
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-file filled bottom-slots v-model="model" label="Label" counter>
                            <template v-slot:prepend>
                            <q-icon name="cloud_upload" @click.stop.prevent />
                            </template>
                            <template v-slot:append>
                            <q-icon name="close" @click.stop.prevent="model = null" class="cursor-pointer" />
                            </template>

                            <template v-slot:hint>
                            File Size
                            </template>
                            </q-file>
                            </q-card-section>
                            <q-card-actions align="right" class="text-primary">
                            <q-btn flat label="Cancel" v-close-popup />
                            <q-btn flat label="Submit" v-close-popup />
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
      }
    }
  }
}

</script>

<style>

.q-layout {
    background-image: url(../../image/loginWallpaper.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}
.q-header , .q-drawer {

    background-color: transparent;
}
.q-card {

    background-color: transparent;
}
.q-item {

    color: white;
    width: 95%;
    margin: 0 auto;
    margin-top: 10px;
    border-radius: 20px;
}
.q-item:visited {

    color: white;
}
.q-item:hover {

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

    background-color: transparent;
    color: whitesmoke;
}
.updateBtn {

    width: 200px;
    height: 50px;
    border-radius: 20px;
    background-color: rgb(30, 30, 202);
    color: white;
}
.updateBtn:hover {

    transition: 0.2s ease-in-out;
    transform: scale(103%);
    background-color: rgb(23, 23, 177);
}
.logoutBtn {

    margin-top: 20px;
    border-radius: 100px;
    color: red;
}
.logoutBtn:hover {

    color: azure;
    transition: 0.2s ease-in-out;
    transform: scale(103%);
    background-color: red;
}
</style>
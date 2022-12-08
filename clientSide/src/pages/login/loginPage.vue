<template>
    <q-page class="window-height window-width row justify-center items-center">
        <div class="column">
            <div class="row">
            <h5 class="text-h5 text-white q-my-md">Welcome To Open World</h5>
            </div>

            <div class="row">
                <q-card rounded bordered class="q-pa-lg">

                    <q-card-section>
                        <q-form class="q-gutter-md">
                            <q-input square filled clearable v-model="user.username" type="email" label="Email" />
                            <q-input square filled clearable v-model="user.password" type="password" label="Password" />
                        </q-form>
                    </q-card-section>

                    <q-card-actions class="q-px-md">
                        <q-btn @click="login" unelevated size="lg" class="full-width" label="Login" />
                    </q-card-actions>

                    <q-card-section class="text-center q-pa-none">
                    </q-card-section>
                </q-card>
            </div>
        </div>
    </q-page>
</template>

<script>

import{User} from 'src/models/user';
import{ref} from 'vue';
import{useAuthStore} from 'src/stores/auth-store';
import{useRouter} from 'vue-router';

const user = ref(new User('guest'));

export default {

    name: 'firstLogin',

    data (){
        const authStore = useAuthStore();
        const router = useRouter();

        return {
            user,
            
            login() {

                authStore.authenticate(user.value.username , user.value.password)
                .then(() => {

                    router.replace({name:'dashboard'});
                },
                (error) => {

                    console.log(`No Internet, Connection Lost because serve not served\n${error}`)
                },);
            }
        }
    },
}
</script>

<style>
    .q-page {
        background-image: url(../../image/loginWallpaper.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }
    .q-card {
        width: 400px;
        background-color: rgba(255, 255, 255, 0.88);
    }
    .q-btn {

        border-radius: 20px;
        background-color: rgb(30, 30, 202);
        color: white;
    }
    .q-btn:hover {

        transition: 0.2s ease-in-out;
        transform: scale(103%);
        background-color: rgb(23, 23, 177);
    }
</style>
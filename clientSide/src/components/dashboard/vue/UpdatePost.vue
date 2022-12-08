<script lang="ts" setup>

    
</script>

<template>

<q-dialog v-model="updatePost" persistent>
    <q-card style="min-width: 350px">
    <q-card-section>
    <div class="text-h6">Update Post</div>
    </q-card-section>
    <q-card-section class="q-pt-none">
    <q-input dense @keyup.enter="updatePost = false" model-value="" label="Enter Your Title"/>
    </q-card-section>
    <q-card-section class="q-pt-none">
    <q-input type="textarea" dense @keyup.enter="updatePost = false" model-value="" label="Enter Your Description"/>
    </q-card-section>
    <q-card-section class="q-pt-none">
    <q-file filled bottom-slots v-model="model" label="Post Image" counter>
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
    <q-btn color="red" icon-right="close" label="Cancel" @click="updatePost = false"/>
    <q-btn color="light-blue-8" icon-right="update" label="Update" />
    </q-card-actions>
    </q-card>
    </q-dialog>
    <q-dialog v-model="deletePost">
    <q-card class="my-card" style="min-width: 350px;">
    <q-img src="src/image/mountains.jpg" />
    <q-card-section>
    <q-btn
    fab
    color="primary"
    icon="place"
    class="absolute"
    style="top: 0; right: 12px; transform: translateY(-50%);"
    />
    <div class="row no-wrap items-center">
    <div class="col text-h6 ellipsis">
    Masal
    </div>
    </div>
    </q-card-section>
    <q-card-section class="q-pt-none">
    <div class="text-subtitle1">
    Hossein Pourghadiri
    </div>
    <div class="text-caption text-grey">
    Best Mountains and View In World
    </div>
    </q-card-section>
    <q-separator />
    <q-card-actions align="right">
    <q-btn color="light-blue-8" icon-right="close" label="Cancel" @click="deletePost = false"/>
    <q-btn color="red" icon-right="delete" label="Remove" />
    </q-card-actions>
    </q-card>
</q-dialog>
</template>
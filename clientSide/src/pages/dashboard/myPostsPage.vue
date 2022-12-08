<template>

    <div class="q-pa-md">
        <q-table :grid="$q.screen.xs" title="My Posts" :rows="rows" :columns="columns" row-key="name" :filter="filter">
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input>
                <q-btn label="Create New Post" color="light-blue-8" class="q-ml-md" @click="createPost = true"/>
                
                <q-dialog v-model="createPost" persistent>
                    <q-card style="min-width: 350px">
                        <q-card-section>
                            <div class="text-h6">Create Post</div>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-input dense @keyup.enter="createPost = false" model-value="" label="Enter Your Title"/>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-input type="textarea" dense @keyup.enter="createPost = false" model-value="" label="Enter Your Description"/>
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
                            <q-btn color="red" icon-right="close" label="Cancel" @click="createPost = false"/>
                            <q-btn color="light-blue-8" icon-right="create" label="Create" />
                        </q-card-actions>
                    </q-card>
                </q-dialog>
            </template>

            <template v-slot:header="props">
                <q-tr :props="props">
                    <q-th v-for="col in props.cols" :key="col.name" :props="props" >
                        {{ col.label }}
                    </q-th>
                    <q-th auto-width>
                        Tools
                    </q-th>
                </q-tr>
            </template>

            <template v-slot:body="props">
                <q-tr :props="props">
                    <q-td v-for="col in props.cols" :key="col.name" :props="props">
                        {{ col.value }}
                    </q-td>
                    <q-td auto-width>
                    <q-btn class="q-ma-sm" size="md" color="warning" dense icon="update" @click="updatePost = true"/>
                    <q-btn class="q-ma-sm" size="md" color="red" dense icon="delete" @click="deletePost = true"/>
                    </q-td>
                </q-tr>
            </template>
        </q-table>
    </div>
</template>

<script lang="ts" setup>

    import {ref} from 'vue';
    import {columns,rows} from 'src/components/dashboard/ts/myPostComponent';

    const createPost = ref(false);
    const updatePost = ref(false);
    const deletePost = ref(false);
    const model = ref(null);
    const filter = ref('');
</script>
<style>

.q-page {

    color: white;
}
</style>
<template>

    <div class="q-pa-md">
        <q-table :grid="$q.screen.xs" title="All Users" :rows="rows" :columns="columns" row-key="name" :filter="filter">
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input>
                <q-btn label="Create New User" color="light-blue-8" class="q-ml-md" @click="createUser = true"/>
                <q-dialog v-model="createUser" persistent>
                    <q-card style="min-width: 350px">
                        <q-card-section>
                            <div class="text-h6">Create User</div>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-input dense @keyup.enter="createUser = false" model-value="" label="Enter Your User Name"/>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-input dense @keyup.enter="createUser = false" model-value="" label="Enter Your E-Mail"/>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-input type="password" dense @keyup.enter="createUser = false" model-value="" label="Enter Your Password"/>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            <q-file filled bottom-slots v-model="model" label="Avatar" counter>
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
                            <q-btn color="red" icon-right="close" label="Cancel" @click="createUser = false"/>
                            <q-btn color="light-blue-8" icon-right="create" label="Create" />
                        </q-card-actions>
                    </q-card>
                </q-dialog>
            </template>
        
            <template v-slot:header="props">
                <q-tr :props="props">
                    <q-th v-for="col in props.cols" :key="col.name" :props="props">
                        {{ col.label }}
                    </q-th>
                    <q-th auto-width>
                        {{ "Tools" }}
                    </q-th>
                </q-tr>
            </template>
            <template v-slot:body="props">
                <q-tr :props="props">
                    <q-td v-for="col in props.cols" :key="col.name" :props="props" >
                        {{ col.value }}
                    </q-td>
                    <q-td auto-width>
                        <q-btn class="q-ma-sm" size="md" color="warning" dense icon="update" @click="openConfirmUpdateUserDialog(props.row)"/>
                        <q-btn class="q-ma-sm" size="md" color="red" dense icon="delete" @click="openConfirmDeleteUserDialog(props.row)"/>
                    </q-td>
                </q-tr>
            </template>
        </q-table>
    </div>
    <update-user
        v-model:model-value = "confirmOpenUpdateUser"
        :id = "updateUserParameter.id"
        :name = "updateUserParameter.username"
        :email = "updateUserParameter.email" 
        ></update-user>
    <delete-user

        v-model:model-value = "confirmOpenDeleteUser"
        :id = "deleteUserParameter.id"
        :username = "deleteUserParameter.username"
        ></delete-user>
</template>

<script lang="ts" setup>

    import {ref} from 'vue';
    import {columns,rows} from 'src/components/dashboard/ts/allUserComponent';
    import UpdateUser from 'src/components/dashboard/vue/UpdateUser.vue';
    import DeleteUser from 'src/components/dashboard/vue/DeleteUser.vue';

    const createUser = ref(false);
    const updateUser = ref(false);
    const deleteUser = ref(false);
    const model = ref(null);
    const filter = ref('');

    const updateUserParameter = ref({
        id: <number> 0,
        username: <string> '',
        email: <string> '',
    });

    const deleteUserParameter = ref({
        id: <number> 0,
        username: <string> '',
        email: <string> '',
    });

    const confirmOpenUpdateUser = ref(false);

    const openConfirmUpdateUserDialog = (row:any) => {

        updateUserParameter.value.id = row.id;
        updateUserParameter.value.username = row.name;
        updateUserParameter.value.email = row.email;
        confirmOpenUpdateUser.value = true;
    }

    const confirmOpenDeleteUser = ref(false);

    const openConfirmDeleteUserDialog = (row:any) => {
        
        deleteUserParameter.value.id = row.id;
        deleteUserParameter.value.username = row.name;
        confirmOpenDeleteUser.value = true;
    }
</script>
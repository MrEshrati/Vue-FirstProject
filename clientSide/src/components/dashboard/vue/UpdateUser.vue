<template>

    <q-dialog :model-value="modelValue" persistent>
        <q-card style="min-width: 350px">
            <q-card-section>
                <div class="text-h6">Update User</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-input dense @keyup.enter="accepted" :model-value="username" label="Enter Your User Name"/>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-input dense @keyup.enter="accepted" :model-value="email" label="Enter Your E-Mail"/>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-input dense @keyup.enter="accepted" :model-value="password" label="Enter Your Password"/>
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
                <q-btn color="red" icon-right="close" label="Cancel" @click="close"/>
                <q-btn color="light-blue-8" icon-right="create" label="Update" @click="accepted" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script setup lang="ts">

    import { defineProps, defineEmits, ref} from 'vue';

    function UpdateUserCounterLabel({totalSize}) {

        return `(${totalSize})`
    }
    
    const model = ref(null);
    const props = defineProps({

        modelValue: {

            default: false,
        },

        id: {
            default: 0,
        },

        username: {

            default: 'Update'
        },

        email: {

            default: 'No Description'
        },
    });

    const emit = defineEmits(['update:model-value' , 'accepted']);

    const close = () => {

        emit.call(this, 'update:model-value', false);
    };

    const accepted = () => {

        emit.call(this, 'accepted');
    };
</script>
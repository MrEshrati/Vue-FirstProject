<template>

    <q-dialog :model-value="modelValue">
        <q-card>
            <q-card-section class="row items-center">
                <q-avatar icon="person" color="primary" text-color="white" />
                <span class="q-ml-sm">Are You Sure, Want You To Delete This User? ({{ username }})</span>
            </q-card-section>

            <q-card-actions align="right">
                <q-btn color="light-blue-8" icon-right="close" label="Cancel" @click="close"/>
                <q-btn color="red" icon-right="delete" label="Delete" @click="accepted" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script setup lang="ts">

    import { defineProps, defineEmits, ref} from 'vue';
    
    const props = defineProps({

        modelValue: {

            default: false,
        },

        id: {
            default: 0,
        },

        username: {

            default: 'No Name'
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
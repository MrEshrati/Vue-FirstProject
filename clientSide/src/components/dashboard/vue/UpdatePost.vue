<template>

    <q-dialog :model-value="modelValue" persistent>
        <q-card class="UpdatePostCard" style="min-width: 350px">
            <q-card-section>
                <div class="text-h6 dialogLabel">Update Post {{ title }} </div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-input class="UpdatePostTitle" :model-value="title" label="Enter Your Title" outlined label-color="lime" color="green"/>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-input class="UpdatePostDescription" type="textarea" :model-value="description" label="Enter Your Description" outlined color="green" label-color="lime"/>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-file bottom-slots v-model="model" label="Post Image" counter :counter-label="UpdatePostCounterLabel" outlined label-color="white" color="green">
                    <template v-slot:prepend>
                        <q-icon name="cloud_upload" @click.stop.prevent color="white" />
                    </template>
                    <template v-slot:append>
                        <q-icon name="close" @click.stop.prevent="model = null" class="cursor-pointer" color="red"/>
                    </template>
                    <template v-slot:hint>
                        <span class="UpdatePostHint">File Size</span>
                    </template>
                </q-file>
            </q-card-section>
            <q-card-actions align="right" class="text-primary">
                <q-btn color="red" icon-right="close" label="Cancel" @click="close"/>
                <q-btn color="light-blue-8" icon-right="update" label="Update" @click="accepted" />
            </q-card-actions>
        </q-card>
    </q-dialog>

</template>

<script setup lang="ts">

    import { defineProps, defineEmits, ref} from 'vue';

    function UpdatePostCounterLabel({totalSize}) {

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

        title: {

            default: 'Update'
        },
        description: {

            default: 'No Description'
        }
    });

    const emit = defineEmits(['update:model-value' , 'accepted']);

    const close = () => {

        emit.call(this, 'update:model-value', false);
    };

    const accepted = () => {

        emit.call(this, 'accepted');
    };
</script>

<style>

.UpdatePostCard {

    background-color: rgba(41, 35, 35, 0.966);
}
.UpdatePostTitle input{

    color: white;
}
.UpdatePostDescription textarea{

    color: white;
}

.UpdatePostHint {

    color: white;
}
.dialogLabel {

    color: white;
}
</style>
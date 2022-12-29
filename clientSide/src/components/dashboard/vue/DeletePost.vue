<template>

    <q-dialog :model-value="modelValue" persistent>
        <q-card class="DeletePostCard" style="min-width: 350px;">
            <q-img :src="img" />
            <q-card-section>
                <q-btn
                fab
                color="primary"
                icon="place"
                class="absolute"
                style="top: 0; right: 12px; transform: translateY(-50%);"
                />
                <div class="row no-wrap items-center">
                    <div class="col text-h6 ellipsis DeletePostTitle">
                        {{ title }}
                    </div>
                </div>
            </q-card-section>
            <q-card-section class="q-pt-none">
                <div class="text-subtitle1 DeletePostUsername">
                    {{ username }}
                </div>
                <div class="text-caption DeletePostDescription">
                    {{ description }}
                </div>
            </q-card-section>
            <q-separator />
            <q-card-actions align="right">
                <q-btn color="light-blue-8" icon-right="close" label="Cancel" @click="close"/>
                <q-btn color="red" icon-right="delete" label="Remove" @click="accepted" />
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

        img: {

            default: 'No Image',
        },

        title: {

            default: 'Update',
        },

        username: {

            default: 'name',
        },

        description: {

            default: 'No Description',
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

.DeletePostCard {

    background-color: rgba(41, 35, 35, 0.966);
}
.DeletePostTitle {

    color: yellow;
}
.DeletePostUsername {

    color: white;
}
.DeletePostDescription {

    color: lime;
}
</style>
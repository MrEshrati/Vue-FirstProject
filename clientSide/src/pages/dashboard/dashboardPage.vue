<template>
    <div class="q-pa-md row items-start q-gutter-md justify-center">
        <q-card class="DashboardPageCard">
            <q-img src="src/image/mountains.jpg" />
            <q-card-section>
                <q-btn fab color="light-blue-8" icon="place" class="absolute" style="top: 0; right: 12px; transform: translateY(-50%);" />
                <div class="row no-wrap items-center">
                    <div class="col text-h6 ellipsis">
                        Masal
                    </div>

                    <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
                    </div>
                </div>
            </q-card-section>
            <q-card-section class="q-pt-none">
                <div class="text-subtitle1">
                    Arshia Eshrati
                </div>

                <div class="text-caption text-grey">
                    Best Mountains and View In World
                 </div>
            </q-card-section>

            <q-separator />

            <q-card-actions>
                <q-btn color="light-blue-8" icon-right="favorite" label="Like (0)" />
            </q-card-actions>
        </q-card>
        <q-card class="DashboardPageCard">
            <q-img src="src/image/mountains.jpg" />
            <q-card-section>
                <q-btn fab color="light-blue-8" icon="place" class="absolute" style="top: 0; right: 12px; transform: translateY(-50%);" />
                <div class="row no-wrap items-center">
                    <div class="col text-h6 ellipsis">
                        Masal
                    </div>

                    <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
                    </div>
                </div>
            </q-card-section>
            <q-card-section class="q-pt-none">
                <div class="text-subtitle1">
                    Arshia Eshrati
                </div>

                <div class="text-caption text-grey">
                    Best Mountains and View In World
                 </div>
            </q-card-section>

            <q-separator />

            <q-card-actions>
                <q-btn color="light-blue-8" icon-right="favorite" label="Like (0)" />
            </q-card-actions>
        </q-card>
        <q-card class="DashboardPageCard">
            <q-img src="src/image/mountains.jpg" />
            <q-card-section>
                <q-btn fab color="light-blue-8" icon="place" class="absolute" style="top: 0; right: 12px; transform: translateY(-50%);" />
                <div class="row no-wrap items-center">
                    <div class="col text-h6 ellipsis">
                        Masal
                    </div>

                    <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
                    </div>
                </div>
            </q-card-section>
            <q-card-section class="q-pt-none">
                <div class="text-subtitle1">
                    Arshia Eshrati
                </div>

                <div class="text-caption text-grey">
                    Best Mountains and View In World
                 </div>
            </q-card-section>

            <q-separator />

            <q-card-actions>
                <q-btn color="light-blue-8" icon-right="favorite" label="Like (0)" />
            </q-card-actions>
        </q-card>
        
    </div>
</template>




<script>
    import { ref } from 'vue'

    export default {
    setup () {
        return {
        stars: ref(4)
        }
    }
    }
</script>

<style lang="sass" scoped>
.DashboardPageCard 
    background-color: whitesmoke
    width: 100%
    max-width: 300px
</style>
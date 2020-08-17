<template>
    <!-- ADD / EDIT MODE -->
    <div>
        <b-breadcrumb :items="breadcrumbItems"></b-breadcrumb>

        <b-container>
            <b-row>
                <b-col>

                    <b-table
                        :items="syncedBoats"
                    :fields="['name', 'description', 'actions']">

                        <template v-slot:cell(actions)="row">
                            <b-button-group>
                                <b-button variant="primary"
                                          @click="show(row.item.id)">
                                    show
                                </b-button>
                                <b-button variant="warning"
                                          @click="edit(row.item.id)">
                                    edit
                                </b-button>
                                <b-button variant="danger"
                                          @click="del(row.item.id)">
                                    delete
                                </b-button>
                            </b-button-group>
                        </template>

                    </b-table>

                </b-col>
            </b-row>
        </b-container>

        <b-button-group>

            <b-button
                variant="success"
                @click="create">
                Create a new boat
            </b-button>

        </b-button-group>


    </div>
</template>

<script>
// 2. think about edition
import endpoints from "../../endpoints";

export default {
    props: {
        boats: Array
    },

    mounted() {
        this.syncedBoats = this.boats
    },

    data: function () {
        return {
            syncedBoats: [],
            breadcrumbItems: [
                {
                    text: 'Boat list',
                    href: '/boat/list',
                },
            ],
        }
    },

    methods: {
        create() {
            window.location.href = '/boat'
        },
        show(id) {
            window.location.href = `/boat/${id}`
        },
        edit(id) {
            window.location.href = `/boat/${id}/edit`
        },
        del(id) {
            this.$axios.delete(endpoints["api-boat-delete"].route(id)).then(response => {
                const {id} = response.data.boat
                this.syncedBoats = this.syncedBoats.filter(boat => {
                    return String(boat.id) !== String(id)
                })
            })
        },
    },

    computed: {}
}

</script>

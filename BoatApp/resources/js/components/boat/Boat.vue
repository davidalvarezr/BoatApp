<template>
    <!-- ADD / EDIT MODE -->
    <div>
        <b-breadcrumb :items="adaptedBreadcrumb"></b-breadcrumb>

        <b-container>
            <b-row>
                <b-col md="6">

                    <b-form-group
                        label="Name"
                        :description="String(nameRemLength)"
                        :invalid-feedback="invalidNameFeedback"
                        :state="isNameValid">
                        <b-input v-model="name" :readonly="mode === 'show'"/>
                    </b-form-group>

                </b-col>
                <b-col md="6">

                    <b-form-group
                        label="Description"
                        :description="String(descriptionRemLength)"
                        :invalid-feedback="invalidDescriptionFeedback"
                        :state="isDescriptionValid">
                        <b-form-textarea v-model="description" :readonly="mode === 'show'"/>
                    </b-form-group>

                </b-col>
            </b-row>
        </b-container>

        <b-button-group>

            <b-button
                v-if="mode === 'show'"
                variant="warning"
                @click="edit">
                Edit
            </b-button>
            <b-button
                v-if="mode === 'show'"
                variant="danger"
                @click="del">
                Delete
            </b-button>
            <!-- ADD / EDIT -->
            <b-button
                v-if="mode !== 'show'"
                variant="success"
                :disabled="!(isNameValid && isDescriptionValid)"
                @click="buttonBehaviour">
                {{ buttonLabel }}
            </b-button>
            <b-button
                v-if="mode === 'edit'"
                variant="danger"
                @click="cancelEdit">
                Cancel
            </b-button>

        </b-button-group>


    </div>
</template>

<script>
// 2. think about edition
import endpoints from "../../endpoints";

export default {
    props: {
        initMode: String,
        boatId: String,
        boatName: String,
        boatDescription: String,
    },

    mounted() {
        this.mode = this.initMode
        if (this.mode === 'edit' || this.mode === 'show') {
            this.id = this.boatId
            this.name = this.boatName
            this.description = this.boatDescription
        }
    },

    data: function () {
        return {
            mode: '',
            id: 0,
            name: '',
            description: '',
            breadcrumbItems: [
                {
                    text: 'Boat list',
                    href: '/boat/list',
                },
            ],
            stateBeforeEdit: {
                name: '',
                description: '',
            }
        }
    },

    methods: {
        store() {
            this.$axios.post(endpoints["api-boat-store"].route, {
                name: this.name,
                description: this.description,
            }).then(response => {
                this.show(response.data.boat)
            })
        },
        update() {
            this.$axios.put(endpoints["api-boat-update"].route(this.id), {
                name: this.name,
                description: this.description,
            }).then(response => {
                this.show(response.data.boat)
            })
        },
        del() {
            this.$axios.delete(endpoints["api-boat-delete"].route(this.id)).then(response => {
                window.location.href = '/boat/list'
            })
        },
        edit() {
            this.stateBeforeEdit = {
                name: this.name,
                description: this.description,
            }
            this.mode = 'edit'
        },
        cancelEdit() {
            const {name, description} = this.stateBeforeEdit
            this.name = name
            this.description = description
            this.show()
        },
        show(boatData = null) {
            if (boatData !== null) {
                this.id = boatData.id
                this.name = boatData.name
                this.description = boatData.description
            }
            this.mode = 'show'
        },
    },

    computed: {
        adaptedBreadcrumb() {
            switch (this.mode) {
                case 'edit':
                case 'show':
                    return [
                        ...this.breadcrumbItems,
                        {
                            text: 'Boat ' + this.id,
                            active: true,
                        }
                    ]
                case 'create':
                    return [
                        ...this.breadcrumbItems,
                        {
                            text: 'Boat creation',
                            active: true,
                        }
                    ]
            }
        },
        nameRemLength() {
            return 127 - this.name.length
        },
        isNameValid() {
            return this.nameRemLength > 0 && this.name.length > 0
        },
        invalidNameFeedback() {
            if (this.nameRemLength <= 0) {
                return 'Too many characters'
            } else if (this.name.length <= 0) {
                return 'At least one character'
            }
        },

        descriptionRemLength() {
            return 511 - this.description.length
        },
        isDescriptionValid() {
            return this.descriptionRemLength > 0 && this.description.length > 0
        },
        invalidDescriptionFeedback() {
            if (this.descriptionRemLength <= 0) {
                return 'Too many characters'
            } else if (this.description.length <= 0) {
                return 'At least one character'
            }
        },

        buttonLabel() {
            switch (this.mode) {
                case 'edit':
                    return 'Update'
                case 'create':
                    return 'Create'
            }
        },
        buttonBehaviour() {
            switch (this.mode) {
                case 'edit':
                    return this.update
                case 'create':
                    return this.store
            }
        }

    }
}

</script>

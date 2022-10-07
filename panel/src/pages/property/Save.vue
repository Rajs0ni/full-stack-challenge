<template>
  <div>
    <v-card class="card--flex-toolbar">
      <v-card-text class="pa-0">
        <v-form ref="form">
          <v-card flat>
            <v-card-title class="grey lighten-4">
              <div class="greyDarken1--text font-weight-medium">
                Property
              </div>
            </v-card-title>
            <v-card-text>
              <!-- County -->
              <v-text-field
                id="county"
                label="County"
                name="county"
                :rules="[
                          rules.required,
                          rules.min_length(3),
                          rules.max_length(250),
                        ]"
                counter="250"
                color="primary"
                prepend-icon="$vuetify.icons.document"
                type="text"
                v-model="property.county"
              ></v-text-field>
              <!-- Country -->
              <v-text-field
                id="country"
                label="Country"
                name="country"
                :rules="[
                          rules.required
                        ]"
                color="primary"
                prepend-icon="$vuetify.icons.document"
                type="text"
                v-model="property.country"
              ></v-text-field>
              <!-- Town -->
              <v-text-field
                id="town"
                label="Town"
                name="town"
                :rules="[
                          rules.required
                        ]"
                color="primary"
                prepend-icon="$vuetify.icons.document"
                type="text"
                v-model="property.town"
              ></v-text-field>
              <!-- Postal Code -->
              <v-text-field
                id="postal_code"
                label="Postcode"
                name="postal_code"
                color="primary"
                prepend-icon="$vuetify.icons.document"
                type="text"
                v-model="property.postal_code"
              ></v-text-field>
               <!-- Description -->
              <div class="mt-2">
                <v-textarea
                name="description"
                prepend-icon="$vuetify.icons.document"
                label="Description"
                v-model="property.description"
              ></v-textarea>
              <!-- Address -->
              <v-text-field
                id="address"
                label="Address"
                name="address"
                :rules="[
                          rules.required
                        ]"
                color="primary"
                prepend-icon="$vuetify.icons.document"
                type="text"
                v-model="property.address"
              ></v-text-field>
              <!-- Number of Bedrooms -->
               <v-select
                v-model="property.num_bedrooms"
                :items="Array.from({length: 100}, (_, i) => i + 1)"
                label="Number of Bedrooms"
              ></v-select>
              <!-- Number of Bathrooms -->
               <v-select
                v-model="property.num_bathrooms"
                :items="Array.from({length: 100}, (_, i) => i + 1)"
                label="Number of Bathrooms"
              ></v-select>
               <!-- Price -->
              <v-text-field
                id="price"
                label="Price"
                name="price"
                :rules="[
                          rules.required,
                          rules.floating_number
                        ]"
                color="primary"
                prepend-icon="$vuetify.icons.document"
                type="text"
                v-model="property.price"
              ></v-text-field>
               <!-- Property Type -->
               <v-select
                v-model="property.property_type_id"
                :rules="[
                          rules.required
                        ]"
                :items="propertyTypes"
                label="Property Type"
                item-text="title"
                item-value="id"
              ></v-select>
              <!-- Type -->
              <v-radio-group v-model="property.type" row>
                <v-radio color="primary" label="For Sale" value="sale"></v-radio>
                <v-radio color="primary" label="For Rent" value="rent"></v-radio>
              </v-radio-group>
              </div>
            </v-card-text>
          </v-card>
          <v-card-actions class="pa-3">
            <v-spacer></v-spacer>
             <v-btn
              @click="$router.push({name: 'property.list'})"
              color="grey"
              dark
            >Cancel</v-btn>
            <v-btn
              v-if="property.id != undefined"
              @click="save('update')"
              color="secondary"
              dark
            >Update</v-btn>
            <v-btn v-else @click="save('create')" color="secondary" dark>
              Create
            </v-btn>
          </v-card-actions>
        </v-form>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import rules from "@/validation";

export default {
  name: "PropertySave",
  data() {
    return {
      rules,
      property: {
        id:null,
        county: null,
        country: null,
        town: null,
        postal_code: null,
        description: null,
        address: null,
        num_bedrooms: 1,
        num_bathrooms: 1,
        price: null,
        property_type_id: null,
        type: null,
        is_admin_entry:true
      },
      propertyTypes:[]
    };
  },
  created(){
    this.fetchPropertyTypes()
  },
  mounted() {
    this.get();
  },
  methods: {
    async fetchPropertyTypes(){
      try {
        let response = await this.$store.dispatch("propertyType/list", {});
        this.propertyTypes = response.propertyTypes;
      }
      catch(error){
        this.$store.dispatch("app/showMessage", {
          message: error.message,
          color: "error"
        });
      }
    },
    async get() {
      if (this.$route.params.property_id == undefined) {
        return;
      }
      let result = await this.$store.dispatch("property/get", {
        id: this.$route.params.property_id
      });
      var property = Object.assign({}, result);
      this.property = property;
    },

    async save(operation) {
      if (!this.$refs.form.validate()) {
        return false;
      }
      try {
        // As admin is going to create & update
        this.property.is_admin_entry = true;
        await this.$store.dispatch(
          "property/" + operation,
          this.property
        );

        this.$router.push({
          name: "property.list"
        });
        this.$store.dispatch("app/showMessage", {
          message: operation == "create" ? "Property created successfully !!" : "Property updated successfully !!",
          color: this.DEFINES.SNACKBAR_SUCCESS_COLOR
        });
      } catch (error) {
        this.$store.dispatch("app/showMessage", {
          message: error.message,
          color: "error"
        });
      }
    }
  }
};
</script>


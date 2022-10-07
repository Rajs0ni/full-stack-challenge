<template>
  <v-card>
    <v-card-title primary-title>
      <div>
        <div class="headline secondary--text">Properties</div>
        <span class="body-1 greyDarken1--text">List of Property</span>
      </div>
      <v-spacer></v-spacer>
      <v-btn color="secondary" dark class="mx-0" @click="$router.push({name: 'property.create'})">
        <v-icon small>$vuetify.icons.create</v-icon>
        Create
      </v-btn>
    </v-card-title>
    <v-card flat>
      <v-card-text class="px-0">
        <v-data-table
          :headers="table_headers"
          :items="list"
          :loading="loading"
          v-bind:pagination.sync="pagination"
        >
          <template v-slot:items="props">
            <tr
              :style="{cursor: 'pointer'}"
              @click.stop="
                $router.push({
                  name: 'property.save',
                  params: {
                    property_id: props.item.id,
                  },
                })
              "
            >
              <td class="text-xs-left">{{ props.item.county }}</td>
              <td class="text-xs-left">{{ props.item.country }}</td>
              <td class="text-xs-left">{{ props.item.town }}</td>
              <td class="text-xs-left">{{ props.item.num_bedrooms }}</td>
              <td class="text-xs-left">{{ props.item.num_bathrooms }}</td>
              <td class="text-xs-left">{{ props.item.price }}</td>
              <td class="text-xs-left">{{ props.item.type }}</td>
              <td
                class="text-xs-left"
              >{{ moment.utc(props.item.created_at).local().format('MMMM Do YYYY') }}</td>
              <td class="text-xs-center">
                <v-tooltip slot="append" top color="white">
                  <v-btn
                    slot="activator"
                    icon
                    small
                    dark
                    @click.stop="
                      $router.push({
                        name: 'property.save',
                        params: {
                          property_id: props.item.id,
                        },
                      })
                    "
                  >
                    <v-icon color="secondary">$vuetify.icons.visibility</v-icon>
                  </v-btn>
                  <span class="greyDarken3--text body-1">
                    View
                  </span>
                </v-tooltip>

                <v-tooltip slot="append" top color="white">
                  <v-btn
                    slot="activator"
                    icon
                    small
                    dark
                    @click.stop="deleteConfirmation(props.item.id)"
                  >
                    <v-icon color="secondary">$vuetify.icons.delete</v-icon>
                  </v-btn>
                  <span class="greyDarken3--text body-1">
                   Delete
                  </span>
                </v-tooltip>
              </td>
            </tr>
          </template>
        </v-data-table>
        <ConfirmationDialog
          :dialog="confirmation"
          @confirm="remove()"
          @cancel="confirmation = false"
        />
      </v-card-text>
    </v-card>
  </v-card>
</template>
<script>
import { mapState } from "vuex";
import ConfirmationDialog from "@/components/dialogBox/Confirmation";

export default {
  name: "PropertyList",
  data() {
    return {
      search: "",
      total: 0,
      confirmation: false,
      loading: true,
      table_headers: [
        {
          text: "County",
          align: "left",
          sortable: true,
          value: "county"
        },
        {
          text: "Country",
          align: "left",
          sortable: true,
          value: "country"
        },
        {
          text: "Town",
          align: "left",
          sortable: true,
          value: "town"
        },
        {
          text: "Bedrooms",
          align: "left",
          sortable: true,
          value: "num_bedrooms"
        },
        {
          text: "Bathrooms",
          align: "left",
          sortable: true,
          value: "num_bathrooms"
        },
        {
          text: "Price",
          align: "left",
          sortable: true,
          value: "price"
        },
        {
          text: "Type",
          align: "left",
          sortable: true,
          value: "type"
        },
        {
          text: "Created At",
          align: "left",
          sortable: true,
          value: "created_at"
        }
      ],
      pagination: { sortBy: "county", descending: true, rowsPerPage: 10 },
      deletePropertyId: null
    };
  },
  created() {
    this.getApiData();
  },
  computed: {
    ...mapState({
      list: state => state.property.list
    })
  },
  components: { ConfirmationDialog },
  methods: {
    async getApiData() {
      this.loading = true;
      try {
        var response = await this.$store.dispatch("property/list");
        console.log(response);
        this.total = response.properties.total;
      } catch (error) {
        this.$store.dispatch("app/showMessage", {
          message: error.message,
          color: this.DEFINES.SNACKBAR_ERROR_COLOR
        });
      }
      this.loading = false;
    },

    async remove() {
      try {
        await this.$store.dispatch("property/delete", {
          id: this.deletePropertyId
        });
        this.getApiData();
      } catch (error) {
        this.$store.dispatch("app/showMessage", {
          message: error.message,
          color: this.DEFINES.SNACKBAR_ERROR_COLOR
        });
      } finally {
        this.confirmation = false;
      }
    },
    deleteConfirmation(property_id) {
      this.deletePropertyId = property_id;
      this.confirmation = true;
    }
  }
};
</script>

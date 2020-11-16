<template>

  <form @submit.prevent="submit"
        autocomplete="off"
        @keydown="form.onKeydown($event)">

    <group-column v-if="$slots.form_title">
      <h5>
        <slot name="form_title"></slot>
      </h5>
    </group-column>

    <!-- Inputs -->
    <group-column v-for="({name, type, label, options}, key) in inputs"
                  v-show="type !== 'hidden'"
                  :key="key"
                  :name="name">

      <!--Checkbox-->
      <div v-if="type === 'checkbox'"
           class="custom-control custom-checkbox p-2 pl-4">

        <input class="custom-control-input"
               v-model="form[name]"
               :type="type"
               :id="name"
               :class="{ 'is-invalid': form.errors.has(name) }"
               :value="form[name]"
               :name="name">
        <label role="button" class="custom-control-label my-auto" :for="name"></label>
        <has-error :form="form" :field="name"/>
      </div>

      <div v-else-if="type === 'search'">
        <input :name="name" v-model="form[name]" type="hidden">
        <v-select
          :label="label"
          :options="search_options[name]"
          :value="search_selected[name]"
          :placeholder="$t('input.search')"
          :clearable="false"
          @input=" value => searchChange(name, value)"
          @search="(search, loading) => onSearch( label, name, search, loading)">

          <template slot="no-options">
            {{$t('alert.type_to_search')}} {{$t(`input.${name}`)}}
          </template>

        </v-select>
      </div>

      <!--Radio-->
      <div v-else-if="type === 'radio'">

        <div v-for="({value, label}) in options"
             :key="value"
             class="form-check">
          <input class="form-check-input"
                 v-model="form[name]"
                 :type="type"
                 :id="`${key}_${value}`"
                 :class="{ 'is-invalid': form.errors.has(name) }"
                 :value="value"
                 :name="name">
          <label class="form-check-label" :for="`${key}_${value}`">
            {{ label }}
          </label>
        </div>
        <has-error :form="form" :field="name"/>
      </div>

      <!--Hidden-->
      <div v-else-if="type === 'hidden'">
        <input v-model="form[name]"
               :type="type"
               :name="name">
      </div>

      <!--Text, Number, Email, Password etc-->
      <div v-else>
        <input v-model="form[name]"
               class="form-control"
               :id="name"
               :class="{ 'is-invalid': form.errors.has(name) }"
               :type="type"
               :name="name">
        <has-error :form="form" :field="name"/>
      </div>
    </group-column>

    <alert-success :form="form" :message="successMessage"/>
    <alert-errors :form="form" :message="errorMessage"></alert-errors>

    <!-- Submit Button -->
    <group-column>
      <v-button :loading="form.busy" type="success">
        {{ $t('button.update') }}
      </v-button>
    </group-column>

  </form>

</template>

<script>
import 'vue-select/dist/vue-select.css';
import vSelect from 'vue-select';
import {AlertSuccess, AlertError, AlertErrors, Form, HasError} from "vform/src";
import GroupColumn from "~/components/form/GroupColumn";
import VButton from "~/components/buttons/VButton";
import Card from "~/components/Card";
import i18n from '~/plugins/i18n';
import debounce from 'lodash.debounce';


export default {
  name: "MyForm",
  props: {
    method: {type: String, default: 'post'},
    url: {type: String, default: false},
    reset: {type: Boolean, default: false},
    options: {type: Object, default: () => ({})},
    search_options: {type: Array, default: () => []},
    search_selected: {type: Object, default: () => ({})},
    inputs: {type: Array, default: () => []},
    data: {type: Object, default: () => ({})},
    successMessage: {type: String, default: i18n.t('alert.info_updated')},
    errorMessage: {type: String, default: i18n.t('alert.info_error')}

  },

  data() {
    return {
      form: new Form()
    }
  },

  components: {
    vSelect,
    HasError,
    AlertSuccess,
    AlertErrors,
    AlertError,
    GroupColumn,
    VButton,
    Card
  },

  methods: {
    submit() {
      const {form, method, url, options, reset} = this;

      form.submit(method, url, options)
        .then(response => {
          this.$emit('submit', response)

          if (response.status === 200 && reset) {
            form.reset()
            this.$forceUpdate()
          }
        })
    },
    searchChange(name, value){
      this.form[name] = value.id
      this.search_selected[name] = value
      this.$forceUpdate()
    },
    onSearch(label, name, search, search_loading) {
      if(!search) return
      search_loading(true);
      this.search(label, name, search_loading, search, this);
    },
    search: debounce((label, name, search_loading, search, vm) => {

        fetch(`/api/company-search?${label}=${escape(search)}`)
          .then(res => res.json())
          .then(({data}) => {
              vm.search_options[name] = data;
              search_loading(false);
              vm.$forceUpdate()
            }
          );
      },
      350),
  },

  created() {
    const {inputs, data, form} = this
    inputs.forEach(({name}) => {
      form[name] = data[name] || null
    })
  },
}
</script>

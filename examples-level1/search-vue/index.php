<!DOCTYPE html>
<html>
  <head>
    <title>Portalhaus Vue.js</title>
    <link rel="stylesheet" type="text/css" href="/search/style.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- include VueJS first -->
<script src="https://unpkg.com/vue@latest"></script>

<!-- use the latest vue-select release -->
<script src="https://unpkg.com/vue-select@latest"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
<script src="https://unpkg.com/lodash@4.17.19/lodash.min.js"></script>
  </head>
  <body>
<div id="app" class="col-md-4">
  <h1>Vue Select - Ajax</h1>
  <v-select label="comuna" :filterable="false" :options="options" @search="onSearch">
    <template slot="no-options">
      Busque su comuna
    </template>
    <template slot="option" slot-scope="option">
      <div class="d-center">
        <!-- <img :src='option.owner.avatar_url' /> -->
        {{ option.comuna }}
      </div>
    </template>
    <template slot="selected-option" slot-scope="option">
      <div class="selected d-center">
        <!-- <img :src='option.owner.avatar_url' /> -->
        {{ option.comuna }}
      </div>
    </template>
  </v-select>
</div>
<script>
Vue.component("v-select", VueSelect.VueSelect);

new Vue({
  el: "#app",
  data: {
    options: [] },

  methods: {
    onSearch(search, loading) {
      loading(true);
      this.search(loading, search, this);
    },
    search: _.debounce((loading, search, vm) => {
      fetch(
      `https://www.portalhaus.cl/ajax/comuna/?term=${escape(search)}`).
      then(res => {
        res.json().then(json => vm.options = json.items);
        loading(false);
      });
    }, 350) } });

        </script>
  </body>
</html>


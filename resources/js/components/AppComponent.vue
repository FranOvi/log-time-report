<template>
  <div class="container">
    <div class="row mb-3">
      <div class="col-12">
          <!-- search -->
          <div class="form-group">
            <input type="text" class="form-control" value="" placeholder="Buscar por nombre o email">
          </div>
      </div>
      <div class="col">
          <!-- order_by -->
          <div class="form-group">
            <label for="start_date">Desde:</label>
            <input name="start_date" type="date" class="form-control" value="">
          </div>
      </div>
      <div class="col">
          <!-- order_by -->
          <div class="form-group">
            <label for="end_date">Hasta:</label>
            <input name="end_date" type="date" class="form-control" value="">
          </div>
      </div>

      <div class="col">
          <!-- order_by -->
          <div class="form-group">
            <label for="order_by">Ordenar por</label>
            <select name="order_by" class="custom-select">
              <option value="">Seleccione</option>
              <option value="name">Nombre</option>
              <option value="email">Email</option>
              <option value="date">Fecha</option>
              <option value="time">Tiempo</option>
            </select>
          </div>
      </div>
    </div>



    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-borderless table-hover">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Fecha</th>
                <th scope="col">Tiempo</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value_logged_times in allLoggedTimes" :key="value_logged_times.id">
                <td>{{ value_logged_times.name }}</td>
                <td>{{ value_logged_times.email }}</td>
                <td>{{ value_logged_times.log_date }}</td>
                <td>{{ value_logged_times.log_time }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  computed: {
    ...mapGetters([
      'allLoggedTimes'
    ])
  },

  methods: {
    ...mapActions([
      'getLoggedTimes'
    ])
  },

  created() {
    this.getLoggedTimes();
  }
}
</script>
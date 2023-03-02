@extends('layouts.layout', ['titulo' => 'Administrador de usuarios' ])


@section('content') 
<div id="app" class="card container-fluid shadow-sm bg-white p-4" >
    
    <h2 class="text-center mb-5 text-primary"> <b>Administrador de usuarios</b> </h2>

    <button class="btn btn-success col-md-3 shadow" v-on:click='openModal()' >Agregar</button>

    <div class="table-responsive">
        <bootstrap-table :columns="columns" :data="listado" :options="options" class="table table-striped"></bootstrap-table>
    </div>

    <div id="modal" class="modal" role="dialog">
        <div class="modal-dialog modal-lg" role="document" >
          <div class="modal-content shadow-lg border-0">
            <div class="modal-header">
              <h5 class="modal-title">Administrador Usuarios</h5>
              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form" name="form" v-on:submit='Guardar' validate :class="es_ver" >
                <div class="modal-body bg-modal p-4 px-5">
                
                    <div class="row">

                        <div class="col-12 col-md-12" v-if="errores.length>0" >
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Error en los datos!</strong> <br>
                                <p class="m-0" v-for="err in errores" >-  @{{err}} </p>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Cédula</label>
                                <input type="text" class="form-control" v-model="usuario.cedula" name="cedula" placeholder="Cédula" required />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Categoría</label>
                                <select class="form-control" v-model="usuario.categoria_id" required >
                                    <option selected disabled :value="undefined" >Seleccione una opción</option>
                                    <option v-for="option in categorias" :value="option.id">
                                        @{{ option.nombre }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" class="form-control" v-model="usuario.nombres" placeholder="Nombres" required />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" v-model="usuario.apellidos" placeholder="Apellidos" required />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" v-model="usuario.email" placeholder="Email" required />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Celular</label>
                                <input type="tel" class="form-control" v-model="usuario.celular" placeholder="Celular" required />
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>País</label> 
                                <v-select v-model="usuario.pais" :options="paises" :reduce="it => it.name" label="name" placeholder="Seleccione una opción" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control" v-model="usuario.direccion" placeholder="Dirección" required />
                            </div>
                        </div>
                                    
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
          </div>
        </div>
    </div>

</div> 
@endsection


@section('scripts')

<script>
 
    Vue.component("v-select", VueSelect.VueSelect);
    Vue.component('BootstrapTable', BootstrapTable);

    var app = new Vue({
        el: '#app',
        data: { 
            listado: [],
            categorias: [],
            paises:[],            
            usuario: {},
            errores: [],
            es_ver: '',
            columns: [
                { field: 'categoria', title: 'Categoría', formatter: (value, key, item) => { return value.nombre; } },
                { field: 'cedula', title: 'Cédula' },
                { field: 'nombres', title: 'Nombres' },
                { field: 'apellidos', title: 'Apellidos' },
                { field: 'email', title: 'Email' },
                { field: 'celular', title: 'Celular' },
                {
                    field: 'action',
                    title: '',
                    align: 'center',
                    printIgnore: true,
                    formatter: function () {
                        return  '<button class="btn btn-sm btn-outline-success py-0 btnOpenModalVer mr-1"  > <i class="fas fa-eye"></i> </button>' +
                                '<button class="btn btn-sm btn-outline-info py-0 btnOpenModalEditar mr-1"  > <i class="fas fa-edit"></i> </button>' +
                                '<button class="btn btn-sm btn-outline-danger py-0 btnEliminar" > <i class="fas fa-trash-alt"></i> </button>';
                    },
                    events: {
                        'click .btnOpenModalVer': function (e, value, row) {
                            app.openModal(true, row);
                        },
                        'click .btnOpenModalEditar': function (e, value, row) {
                            app.openModal(false, row);
                        },
                        'click .btnEliminar': function (e, value, row) {
                            app.eliminar(row);
                        }
                    }
                }
            ],
            options: { pagination: true, search: true, showColumns: true, showPrint: true }
        },
        methods: {

            Guardar: function (e)
            {
                e.preventDefault();
                
                if(!this.usuario) return;
                
                this.errores = [];
                let is_crear = true;
                let url = '/personas';

                if(this.usuario.id > 0)
                {
                    url = url + '/'+ this.usuario.id;
                    is_crear = false;
                }

                http.post(url, this.usuario, is_crear)
                    .then(result => {
                        if (result.success) {

                            Swal.fire({ title: 'Registro Guardado', text: "Registro Guardado exitosamente.", icon: 'success', showCancelButton: false, timer: 4000 });
                            $("#modal").modal('hide');

                            if(is_crear)
                            {
                                this.listado.push(result.registro);
                            }
                            else{
                                let index = this.listado.findIndex(x=> x.id == this.usuario.id );
                                for(let nb in result.registro){ this.listado[index][nb] = result.registro[nb]; }
                            }
                        }
                    })
                    .catch(error => { 
                      if(error)
                      {
                        for(let nb in error.errors)
                        {
                            for(let i = 0; i < error.errors[nb].length; i++ )
                            {
                                this.errores.push( nb +": "+ error.errors[nb][i]  );
                            }
                        }
                      } 
                    });
                
            },  
            openModal: function(es_ver, item)
            {
                this.es_ver = es_ver == true ? 'SoloVer' : '';
                this.usuario = item  ? Object.assign({}, item) : {};
                $("#modal").modal('show');
            },
            eliminar: function(item)
            {
                http.eliminar('/personas/'+item.id)
                    .then(result => {
                        if (result.success) {
                            Swal.fire({ title: 'Registro Eliminado', text: "Registro Eliminado exitosamente.", icon: 'success', showCancelButton: false, timer: 4000 });
                            let index = this.listado.findIndex(x=> x.id == this.usuario.id );
                            this.listado.splice(index, 1);
                        }
                    });
            }
        }, 
        created() {
            
            http.get('/categorias')
                    .then( response => {
                        this.categorias = response.data;
                    }).catch(function (error) { console.log(error); });

            http.get('https://restcountries.com/v3.1/region/ame')
                    .then( response => {
                        this.paises = response.data.map(x=> { return { name: x.name.common } });
                    }).catch(function (error) { console.log(error); });

            http.get('/personas')
                .then( response => {
                    this.listado = response.data;
                    $(".cargando").addClass('d-none'); 
                }).catch(function (error) { console.log(error); });

        },
            
    });

</script>

@endsection

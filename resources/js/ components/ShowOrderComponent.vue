<template>
    <div class="container text-center py-5 mx-5">
        <div class="card shadow w-50 m-auto">
                <div class="card-header">Order No. {{order.reference}}</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                        <tr class="text-left">
                            <th>Estado</th>
                            <td>{{order.status}}</td>
                        </tr>
                        <tr class="text-left">
                            <th>Descripcion</th>
                            <td>{{order.description}}</td>
                        </tr>
                        <tr class="text-left">
                            <th>Valor</th>
                            <td>${{order.amount}}</td>
                        </tr>
                        <tr class="text-left ">
                            <th v-if="order.status === 'APPROVED'">Referencia</th>
                            <td v-if="order.status === 'APPROVED'">{{order.requestId}}</td>
                        </tr>
                        <tr class="text-left">
                            <th v-if="order.status === 'APPROVED'">Expira en</th>
                            <td v-if="order.status === 'APPROVED'">{{order.expiration}}</td>
                        </tr>
                        </thead>
                        <tr class="text-left">
                            <th>Url:</th>
                            <td>
                                <div class="col-4 text-truncate ml-0 pl-0">{{order.processUrl}}</div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="btn-group">
                        <form :action="'/orders/verify/' + order.id" method="post" class="m-1">
                            <input type="hidden" name="_token" v-bind:value="token">
                            <button v-if="order.status === 'PENDING'" class="btn btn-info">Validar pago</button>
                        </form>
                        <a :href="order.processUrl" v-if="order.status === 'PENDING'" class="btn btn-success m-1">Pagar</a>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    name: "ShowOrderComponent",
    props: {
        order: {
            type: Object,
            default: {}
        }
    },
    data(){
        return {
            token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
}
</script>

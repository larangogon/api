<template>
    <div class="container text-center py-5 mx-5">
        <div class="card shadow">
                <div class="card-header">Order No. {{order.reference}}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Estado</th>
                            <td>{{order.status}}</td>
                            <th>Descripcion</th>
                            <td>{{order.description}}</td>
                            <th>Valor</th>
                            <td>$.{{order.amount}}</td>
                            <th v-if="order.status === 'APPROVED'">Expira en</th>
                            <td v-if="order.status === 'APPROVED'">{{order.expiration}}</td>
                        </tr>
                        </thead>
                    </table>
                    <table>
                        <th>Url:</th>
                        <td>{{order.processUrl}}</td>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="btn-group">
                        <form :action="'/orders/verify/' + order.id" method="post">
                            <input type="hidden" name="_token" v-bind:value="token">
                            <button v-if="order.status === 'PENDING'" class="btn btn-info">Validar pago</button>
                        </form>
                        <button v-if="order.status === 'PENDING'" class="btn btn-success">Pagar</button>
                    </div>
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

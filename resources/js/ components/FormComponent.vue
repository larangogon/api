<template>
<div class="container text-center py-5 mx-5">
<div class="card shadow">
    <form action="/orders/" method="post">
        <input type="hidden" name="_token" v-bind:value="token">
        <div class="card-header">
            <div class="card-title">Crear órden</div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="inputAmount" class="col-sm-2 col-form-label">Valor a pagar</label>
                <div class="col-sm-10">
                    <input type="number" name="amount" class="form-control" id="inputAmount">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputRef" class="col-sm-2 col-form-label">No de órden</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="reference" id="inputRef">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputDesc" class="col-sm-2 col-form-label">Descripción</label>
                <div class="col-sm-10">
                    <textarea type="text" name="description" class="form-control" id="inputDesc" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" type="submit">Pagar</button>
        </div>
    </form>
</div>
</div>
</template>

<script>
export default {
    name: "FormComponent",
    data(){
        return {
            token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
}
</script>

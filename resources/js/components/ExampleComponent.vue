<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" id="header">فريش كورنر </div>

                    <div class="card-body"  id="header">
                      مرحبا بك في لوحه التحكم  
                      </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
    #header{
        text-align: center;
    }
</style>

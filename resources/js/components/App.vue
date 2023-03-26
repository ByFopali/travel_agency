<template>
    <div>
        <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
            <div class="container">
                <a class="navbar-brand">
                    <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Travel Agency Logo" width="30" height="24" class="d-inline-block align-text-top" style="margin-right: 10px;">
                    <router-link to="/">
                        <span style="font-weight: bold;">Travel Agency</span>
                    </router-link>
                </a>
                <div class="navbar-nav">
                    <router-link class="nav-item nav-link" to="/tours">
                        Tours
                    </router-link>
                    <router-link class="nav-item nav-link" to="/about">
                        About
                    </router-link>
                </div>
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<style scoped>
/* Видалення всіх стилів, які не належать до компонентів */
* {
    text-decoration: none;
    color: black;
}

/* Задання стилів лише для компонентів, використовуючи класи */
.my-component {
    /* Ваші стилі тут */
}
</style>

<script>
export default {
}
</script>

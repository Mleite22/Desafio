<template>
    <div class="sidbar">
        <div class="avatar-top">
            <div class="avatar">
                <span><i class="fa fa-user"></i></span>
            </div>
            <div class="avatar-nome">
                <p>{{name}}</p>
            </div>
        </div>

        <div class="menu">
            <p>Menu</p>
        </div>
    </div>
</template>

<script>

export default {
    name: 'SidBarComponent',
}
</script>

<style scoped>
.sidbar{
    margin-top: 10px;

    .avatar-top{
        width: 100%;
        display: flex;
        justify-content: center;
        background-color: brown;

        span{
            width: 50px;            
            height: 50px;
            border-radius: 50%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
}
</style>
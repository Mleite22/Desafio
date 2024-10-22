<template>

    <div class="main">

        <div class="sidebar">
            <SidBarComponent />

        </div>
        <div class="content-right">

            <div class="navbar">
                <NavBarComponent />

            </div>
            <div class="content">

                <slot name="painel-home">
                </slot>
                <slot name="painel-curso">
                </slot>
                <slot name="painel-alunos">
                </slot>
                <slot name="painel-meuscurso">
                </slot>
                <slot name="painel-inscrevercurso">
                </slot>

            </div>

        </div>

    </div>
</template>

<script>
import NavBarComponent from './componentes/NavBarComponent.vue';
import SidBarComponent from './componentes/SidBarComponent.vue';

export default {
    name: 'DashbordComponent',
    components: {
        NavBarComponent,
        SidBarComponent
    },

}
</script>

<style src="./styleDashboar.css" scoped />
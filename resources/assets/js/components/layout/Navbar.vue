<template>
    <div id="tabs">
        <ul class="nav nav-tabs">
            <li v-bind:class="{ active: tab === 1}" v-on:click="tab = 1">
                <a>Tab 1</a>
            </li>
            <li v-bind:class="{ active: tab === 2}" v-on:click="tab = 2">
                <a>Tab 2</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" v-bind:class="{ active: tab === 1}">
                Pane 1</div>
            <div class="tab-pane" v-bind:class="{ active: tab === 2}">
                Pane 2</div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                tab: ''
            }
        }
    }
</script>
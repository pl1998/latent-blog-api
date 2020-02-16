<template>
    <li v-if="!synClass.children"><a class="dropdown-item" href="">{{synClass.name}}</a></li>
    <li v-else @click.stop="jumpRoute(synClass)"class="dropdown-submenu">
        <a href="" class="dropdown-item dropdown-toggle" data-toggle="dropdown">{{ synClass.name }}</a>
        <ul class="dropdown-menu">
            <!-- 遍历当前类目的子类目，递归调用自己这个模板 -->
            <NavCategory v-for="(item,index) in synClass.children" :synClass="item" :key="index" ></NavCategory>
        </ul>
    </li>

</template>
<script>
    export default {
        name: "NavCategory",
        props: {
            synClass: {
                type: Object,
                default: function () {
                    return {}
                }
            },
        },
        data() {
            return {
                activeIndex: '1',
                activeIndex2: '1'
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            jumpRoute(synClass){
                console.log(synClass)
            }
        }
    }
</script>

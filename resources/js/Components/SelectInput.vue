<script setup>

import { computed } from 'vue';

const emit = defineEmits(['update:modelValue']);
const props = defineProps({
    modelValue: {
        type: [Array],
    },
    options: {
        type: [Array],
    }
});

const multiselectValue = computed({
    get() {
        return props.modelValue;
    },
    set(val) {
        emit('update:modelValue', val);
    },
});

</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-model = "multiselectValue"
    >
        <option v-for="(option, key) in options" :value="key">{{option}}</option>
    </select>
</template>


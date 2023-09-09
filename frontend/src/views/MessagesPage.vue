<template>
  <AppMain title="Messages">
    <DxDataGrid
            :data-source="messages"
            key-expr="id">
    </DxDataGrid>
  </AppMain>
</template>

<script setup lang="ts">
import AppMain from "@/components/main/AppMain.vue";
import { DxDataGrid } from 'devextreme-vue/data-grid';
</script>

<script lang="ts">
import { defineComponent } from 'vue';
import { container } from "tsyringe";
import GetMessagesQuery from '@/logic/infrastructure/query/get-messages-query';

export default defineComponent({
  data() {
    return {
      messages: [],
    }
  },
  async mounted() {
    this.messages = await container.resolve(GetMessagesQuery).getEmployees();
  }
});
</script>

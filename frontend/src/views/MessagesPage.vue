<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-menu-button color="primary"></ion-menu-button>
        </ion-buttons>
        <ion-title>{{ $route.params.id }}</ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content :fullscreen="true">
        <DxDataGrid
                :data-source="messages"
                key-expr="id">
        </DxDataGrid>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import { IonButtons, IonContent, IonHeader, IonMenuButton, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
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

<template>
  <app-main title="Messages">
    <dx-data-grid
            :data-source="messages"
            key-expr="id"
            @selection-changed="onRowSelect">
      <dx-selection mode="single" />
    </dx-data-grid>
    <ion-modal :is-open="isOpen">
      <ion-header>
        <ion-toolbar>
          <ion-title>Message</ion-title>
          <ion-buttons slot="end">
            <ion-button @click="setOpen(false)">Close</ion-button>
          </ion-buttons>
        </ion-toolbar>
      </ion-header>
      <ion-content class="ion-padding">
        <div v-if="modalMessage">
          <ion-list>
            <ion-item>
              <ion-label>
                <b>Id:</b>
                <span class="ion-float-end">{{ this.$data.modalMessage.id }}</span>
              </ion-label>
            </ion-item>
            <ion-item>
              <ion-label>
                <b>Created at:</b>
                <span class="ion-float-end">{{ this.$data.modalMessage.createdAt }}</span>
              </ion-label>
            </ion-item>
            <ion-item>
              {{ this.$data.modalMessage.message }}
            </ion-item>
          </ion-list>
        </div>
      </ion-content>
    </ion-modal>
  </app-main>
</template>

<script setup lang="ts">
import AppMain from "@/components/main/AppMain.vue";
import { IonButtons, IonButton, IonModal, IonHeader, IonToolbar, IonContent, IonTitle, IonList, IonItem, IonLabel } from '@ionic/vue';
import { DxDataGrid, DxSelection } from 'devextreme-vue/data-grid';
</script>

<script lang="ts">
import { defineComponent } from 'vue';
import { container } from 'tsyringe';
import GetAllMessagesQuery from '@/logic/infrastructure/query/get-all-messages-query';
import FindMessageQuery from "@/logic/infrastructure/query/find-message-query";
import MessageDto from "@/logic/domain/dto/message-dto";

export default defineComponent({
  data() {
    return {
      messages: [],
      isOpen: false,
      modalMessage: null as MessageDto | null
    }
  },
  async mounted() {
    this.messages = await container.resolve(GetAllMessagesQuery).getAll();
  },
  methods: {
    async onRowSelect(e) {
      const id: string = e.currentSelectedRowKeys[0];
      this.setOpen(true);
      this.modalMessage = await container.resolve(FindMessageQuery).find(id);
    },
    setOpen(open: boolean) {
      this.isOpen = open;

      if (!this.isOpen) {
        this._clearModalMessage();
      }
    },
    _clearModalMessage() {
      this.modalMessage = null;
    }
  }
});
</script>

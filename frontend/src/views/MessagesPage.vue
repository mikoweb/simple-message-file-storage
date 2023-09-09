<template>
  <app-main title="Messages">
    <dx-data-grid
              :data-source="messages"
              key-expr="id"
              @selection-changed="_onRowSelect">
      <dx-remote-operations :sorting="true"/>
      <dx-sorting mode="single" />
      <dx-selection mode="single" />
      <dx-filter-row :visible="true" />
      <dx-search-panel :visible="true" />
      <dx-column data-field="id">
          <dx-required-rule />
      </dx-column>
      <dx-column
              data-field="createdAt"
              sort-order="desc"
              :customize-text="_formatCreatedAt">
          <dx-required-rule />
      </dx-column>
      <dx-column data-field="message">
        <dx-required-rule />
      </dx-column>
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
                <span class="ion-float-end">{{ this.$data.modalMessage.formattedCreatedAt }}</span>
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
import {
  IonButton,
  IonButtons,
  IonContent,
  IonHeader,
  IonItem,
  IonLabel,
  IonList,
  IonModal,
  IonTitle,
  IonToolbar
} from '@ionic/vue';
import {
  DxColumn,
  DxDataGrid,
  DxFilterRow,
  DxRemoteOperations,
  DxRequiredRule,
  DxSearchPanel,
  DxSelection,
  DxSorting
} from 'devextreme-vue/data-grid';
</script>

<script lang="ts">
import { defineComponent } from 'vue';
import { container } from 'tsyringe';
import GetAllMessagesQuery from '@/logic/infrastructure/query/get-all-messages-query';
import FindMessageQuery from "@/logic/infrastructure/query/find-message-query";
import MessageDto from "@/logic/domain/dto/message-dto";
import DateFormatter from "@/logic/application/date/date-formatter";
import CustomStore from 'devextreme/data/custom_store';
import LoadOptions from 'devextreme/data/load_options';
import MessageSortDto from "@/logic/domain/dto/message-sort-dto";
import MessageSortOptionEnum from "@/logic/domain/enum/message-sort-option";
import SortDirection from "@/logic/domain/enum/sort-direction";
import * as _ from 'lodash';

export default defineComponent({
  data() {
    return {
      messages: new CustomStore({
        key: 'id',
        load: async (loadOptions: LoadOptions) => {
          const sortingOptions: any[] = loadOptions.sort as any[];
          let sort: MessageSortDto | null = null;

          if (sortingOptions.length > 0) {
            const sortOption = MessageSortOptionEnum[_.upperFirst(sortingOptions[0].selector)];
            const sortDirection = sortingOptions[0].desc ? SortDirection.Desc : SortDirection.Asc;

            if (sortOption) {
              sort = new MessageSortDto(sortOption, sortDirection);
            }
          }

          return await container.resolve(GetAllMessagesQuery).getAll(sort);
        }
      }),
      isOpen: false,
      modalMessage: null as MessageDto | null
    }
  },
  methods: {
    setOpen(open: boolean): void {
      this.isOpen = open;

      if (!this.isOpen) {
        this._clearModalMessage();
      }
    },
    async _onRowSelect(e): void {
      const id: string = e.currentSelectedRowKeys[0];
      this.setOpen(true);
      this.modalMessage = await container.resolve(FindMessageQuery).find(id);
    },
    _clearModalMessage(): void {
      this.modalMessage = null;
    },
    _formatCreatedAt(cellInfo): string {
      return DateFormatter.formatToDateTime(cellInfo.value);
    }
  }
});
</script>

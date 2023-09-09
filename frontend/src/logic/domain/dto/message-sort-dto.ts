import SortDirection from '@/logic/domain/enum/sort-direction';
import MessageSortOptionEnum from '@/logic/domain/enum/message-sort-option';

export default class MessageSortDto {
  constructor(
    public readonly sortOption: MessageSortOptionEnum,
    public readonly sortDirection: SortDirection = SortDirection.Asc
  ) {}
}

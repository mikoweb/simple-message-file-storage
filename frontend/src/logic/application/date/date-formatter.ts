import {DateTime} from 'luxon';

export default class DateFormatter {
  public static formatToDateTime(date: DateTime): string {
    return date.toFormat('yyyy-LL-dd HH:mm:ss');
  }
}

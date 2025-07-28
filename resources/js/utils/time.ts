export function formatDuration(duration: number): string {
  // Hours, minutes and seconds
  const hrs = ~~(duration / 3600);
  const mins = ~~((duration % 3600) / 60);
  const secs = ~~duration % 60;

  let formatted = "";

  if (hrs > 0) {
    formatted += "" + hrs + "h" + (mins < 10 ? "0" : "");
  }

  formatted += "" + mins + "min" + (secs < 10 ? "0" : "");
  formatted += "" + secs;

  return formatted;
}

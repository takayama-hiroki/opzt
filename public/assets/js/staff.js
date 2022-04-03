function checkSubmit() {
  if(window.confirm('変更しますか？')) {
      alert('変更しました。');
      return true;
    } else {
      return false;
    }
}

function delSubmit() {
  if(window.confirm('削除しますか？')) {
      alert('削除しました。');
      return true;
    } else {
      return false;
    }
}

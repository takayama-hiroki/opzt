function checkSubmit() {
  if(window.confirm('変更しますか？')) {
      alert('変更しました。');
      return true;
    } else {
      return false;
    }
}

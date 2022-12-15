import { useState } from 'react';
import './App.css';

const Search = (props) => {
  const [textKW, setTextKW] = useState('')
  const [textDM, setTextDM] = useState('')
  const [isLoading, setIsloading] = useState(false)

  const handleSubmit = () => {
    setIsloading(true)
    const API_KEY = 'f6a9da054d937fa3ef2ac05f862da723'
    const keyword = textKW.replace(/ /g, '%20')
    const url_serprobot = `https://api.serprobot.com/v1/api.php?api_key=${API_KEY}&action=rank_check&region=www.google.com.vn&keyword=${keyword}&target_url=${textDM}&device=mobile&competitors[]=facebook.com&competitors[]=example.com&hl=en`
    console.log(url_serprobot)
  }
  const handletextKW = (e) => {
    setTextKW(e.target.value)
  }

  const handletextDM = (e) => {
    setTextDM(e.target.value)
  }

  return <div>
    <input value={textKW} onChange={handletextKW}/>
    <input value={textDM} onChange={handletextDM}/>
    <button onClick={handleSubmit}>Submit</button>
  </div>
}

const Show = (props) => {

}

function App() {
  const [list, setList] = useState([])
  return (<div>
    <Search />
    <Show />
    </div>
  );
}

export default App;

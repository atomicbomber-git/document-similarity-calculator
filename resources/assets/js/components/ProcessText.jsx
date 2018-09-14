import React, {Component, Fragment} from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import {debounce} from 'lodash'

class ProcessText extends Component
{
    constructor(props) {
        super(props)

        this.state = {
            rawText: { first: '', second: '' },
            stemmedText: { first: '', second: '' },
            cleanedText: { first: '', second: '' },
            termFrequency: {},
            freqDist: {}
        }

        this.handleRawTextInputChange = this.handleRawTextInputChange.bind(this)

        this.handleFirstRawTextInputChange = this.handleFirstRawTextInputChange.bind(this)
        this.handleSecondRawTextInputChange = this.handleSecondRawTextInputChange.bind(this)
        
        this.sendRawText = debounce((type) => {
            axios.post('/process/stem', { raw_text: this.state.rawText[type] })
            .then(response => {
                let temp = {}
                temp[type] = response.data.data
                this.setState({ stemmedText: { ...this.state.stemmedText, ...temp } })
                this.cleanStemmedText(response.data.data, type)
            })
            .catch(error => {
                this.setState({ stemmedText: '' })
                console.log(error);
            })
        }, 400)

        this.cleanStemmedText = debounce((text, type) => {
            axios.get('/process/clean', { params: { input: text } })
                .then(response => {
                    let temp = {}
                    temp[type] = response.data.data
                    this.setState({ cleanedText: { ...this.state.cleanedText, ...temp } })

                    if (this.state.cleanedText.first && this.state.cleanedText.second) {
                        this.calcTermFrequency(response.data.data)
                    }
                })
                .catch(error => {
                    this.setState({ cleanedText: '' })
                    console.log(error)
                })
        }, 400)

        this.calcTermFrequency = debounce((text) => {
            axios.get('/process/term_freq', { params: { first: this.state.cleanedText.first, second: this.state.cleanedText.second } })
                .then(response => {
                    this.setState({ termFrequency: response.data.data })
                    console.log(response.data.data)
                })
                .catch(error => {
                    this.setState({ termFrequency: {} })
                    console.log(error)
                })
        }, 400);
    }

    handleFirstRawTextInputChange(e) {
        this.setState({ rawText: {...this.state.rawText, first: e.target.value } });
    }

    handleSecondRawTextInputChange(e) {
        this.setState({ rawText: {...this.state.rawText, second: e.target.value } });
    }

    handleRawTextInputChange(value, type)
    {
        let temp = {}
        temp[type] = value
        this.setState({ rawText: {...this.state.rawText, ...temp} })

        this.sendRawText(type)
    }

    getSimilarity()
    {
        const {termFrequency} = this.state

        let numerator = Object.keys(termFrequency).reduce((carry, key) => {
            return carry + termFrequency[key].a * termFrequency[key].b
        }, 0)

        let len_a = Math.sqrt(Object.keys(termFrequency)
            .map(key => termFrequency[key].a)
            .reduce((carry, val) => { return carry + val * val }, 0))
        
        let len_b = Math.sqrt(Object.keys(termFrequency)
            .map(key => termFrequency[key].b)
            .reduce((carry, val) => { return carry + val * val }, 0))

        return numerator / (len_a * len_b) * 100;
    }

    render() {
        return (
            <Fragment>
                <div className="row"> 
                    <div className="col-md-6  mt-3">
                        <div className="card text-white bg-primary">
                            <div className="card-header">
                                Proses Teks A:
                            </div>

                            <div className="card-body">
                                <form>
                                    <label htmlFor="raw_text">
                                        Teks Mentah:
                                    </label>
                                    <textarea
                                        rows="6"
                                        className='form-control'
                                        name="raw_text"
                                        value={this.state.rawText.first}
                                        onChange={(e) => { this.handleRawTextInputChange(e.target.value, 'first') }}
                                        ></textarea>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6  mt-3">
                        <div className="card text-white bg-success">
                            <div className="card-header">
                                Proses Teks B:
                            </div>

                            <div className="card-body">
                                <form>
                                    <label htmlFor="raw_text">
                                        Teks Mentah:
                                    </label>
                                    <textarea
                                        rows="6"
                                        className='form-control'
                                        name="raw_text"
                                        value={this.state.rawText.second}
                                        onChange={(e) => { this.handleRawTextInputChange(e.target.value, 'second') }}
                                        ></textarea>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-md-6 mt-3">
                        <div className="card text-white bg-primary">
                            <div className="card-header">
                                (A) Hasil Tahap 1 (<em> Stemming </em>):
                            </div>

                            <div className="card-body">
                                <form>
                                    <label htmlFor="stemmed_text_first">
                                        Teks Setelah Melalui Proses <em> Stemming </em>
                                    </label>
                                    <textarea 
                                        readOnly
                                        rows="6"
                                        className='form-control'
                                        name="stemmed_text_first"
                                        value={this.state.stemmedText.first}
                                        ></textarea>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6 mt-3">
                        <div className="card text-white bg-success">
                            <div className="card-header">
                                (B) Hasil Tahap 1 (<em> Stemming </em>):
                            </div>

                            <div className="card-body">
                                <form>
                                    <label htmlFor="stemmed_text_second">
                                        Teks Setelah Melalui Proses <em> Stemming </em>
                                    </label>
                                    <textarea
                                        readOnly
                                        rows="6"
                                        className='form-control'
                                        name="stemmed_text_second"
                                        value={this.state.stemmedText.second}
                                        ></textarea>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-md-6 mt-3">
                        <div className="card text-white bg-primary">
                            <div className="card-header">
                                (A) Hasil Tahap 2 (Pembersihan dari Kata Sambung):
                            </div>

                            <div className="card-body">
                                <form>
                                    <label htmlFor="cleaned_text_second">
                                        Teks Setelah Melalui Proses Pembersihan dari Kata Sambung
                                    </label>
                                    <textarea
                                        readOnly
                                        rows="6"
                                        className='form-control'
                                        name="cleaned_text_second"
                                        value={this.state.cleanedText.first}
                                        ></textarea>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6 mt-3">
                        <div className="card text-white bg-success">
                            <div className="card-header">
                                (B) Hasil Tahap 2 (Pembersihan dari Kata Sambung):
                            </div>

                            <div className="card-body">
                                <form>
                                    <label htmlFor="cleaned_text_second">
                                        Teks Setelah Melalui Proses Pembersihan dari Kata Sambung
                                    </label>
                                    <textarea
                                        readOnly
                                        rows="6"
                                        className='form-control'
                                        name="cleaned_text_second"
                                        value={this.state.cleanedText.second}
                                        ></textarea>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="card mt-3">
                    <div className="card-header">
                        Hasil Tahap 3 (Penghitungan <em>Term Frequency</em>):
                    </div>

                    <div className="card-body">
                        <form>
                            <label htmlFor="raw_text">
                                Frekuensi Token dalam Teks
                            </label>
                            
                            <table className="table table-sm table-striped">
                                <thead className="thead-dark">
                                    <tr>
                                        <th> # </th>
                                        <th> Token </th>
                                        <th> TF(A) </th>
                                        <th> TF(B) </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {Object.keys(this.state.termFrequency).map((token, index) => {
                                        return (
                                            <tr key={index}>
                                                <td> {index + 1}. </td>
                                                <td> {token} </td>
                                                <td> {this.state.termFrequency[token]['a']} </td>
                                                <td> {this.state.termFrequency[token]['b']} </td>
                                            </tr>
                                        )
                                    })}
                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>

                <div>
                    <h1>
                        Tingkat Similaritas: {this.getSimilarity()} %
                    </h1>
                </div>
            </Fragment>
        )
    }
}

let rootElem = document.getElementById('root-process-text')
if (rootElem) {
    ReactDOM.render(<ProcessText/>, rootElem)
}
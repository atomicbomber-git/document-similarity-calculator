import React, {Component, Fragment} from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import {debounce} from 'lodash'

class ProcessText extends Component
{
    constructor(props) {
        super(props)

        this.state = {
            rawText: '',
            stemmedText: ''
        }

        this.handleRawTextInputChange = this.handleRawTextInputChange.bind(this)
        
        this.sendRawText = debounce(() => {
            axios.post('/process/stem', { raw_text: this.state.rawText })
            .then(response => {
                this.setState({ stemmedText: response.data.data })
            })
            .catch(error => {
                this.setState({ stemmedText: '' })
                console.log(error);
            })
        }, 400)
    }

    handleRawTextInputChange(e)
    {
        this.setState({ rawText: e.target.value })
        this.sendRawText()
    }

    render() {
        return (
            <Fragment>
                <div className="card">
                    <div className="card-header">
                        Proses Teks:
                    </div>

                    <div className="card-body">
                        <form>
                            <label htmlFor="raw_text">
                                Teks Mentah:
                            </label>
                            <textarea
                                className='form-control'
                                name="raw_text"
                                value={this.state.rawText}
                                onChange={this.handleRawTextInputChange}
                                ></textarea>
                        </form>
                    </div>
                </div>

                <div className="card mt-3">
                    <div className="card-header">
                        Hasil Tahap 1 (<em> Stemming </em>):
                    </div>

                    <div className="card-body">
                        <form>
                            <label htmlFor="raw_text">
                                Teks Setelah Melalui Proses <em> Stemming </em>
                            </label>
                            <textarea readOnly
                                className='form-control'
                                name="stemmed_text"
                                value={this.state.stemmedText}
                                ></textarea>
                        </form>
                    </div>
                </div>
            </Fragment>
        )
    }
}

let rootElem = document.getElementById('root-process-text')
if (rootElem) {
    ReactDOM.render(<ProcessText/>, rootElem)
}